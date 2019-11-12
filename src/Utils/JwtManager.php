<?php namespace Src\Utils;


use Carbon\Carbon;
use Firebase\JWT\JWT;
use Src\Infraestructure\Exceptions\TokenException;
use UnexpectedValueException;

class JwtManager
{
    private $key;
    private $iss;
    private $exp;
    private const ALG = 'HS256';

    public function __construct(string $key, string $iss, int $exp)
    {
        $this->key = $key;
        $this->iss = $iss;
        $this->exp = $exp;
    }

    public function encodeToken($payload){
        $time_now = Carbon::now();
        $claims = array(
            'iss' => $this->iss,
            'aud' => $this->getAud(),
            'exp' => $time_now->addMicroseconds($this->exp)->timestamp, //cuando expira (horas extra)
//            'iat' => 1356999524,
//            'nbf' => 1357000000,
            'payload' => $payload
        );
        return JWT::encode($claims, $this::ALG);
    }

    public function decodeToken(string $token)
    {
        try{
            if( empty($token) || $token === null || $token === "null" )
                return null;
            
            
            return JWT::decode($token, $this->key,  array($this::ALG));

        }catch (UnexpectedValueException $ex){
            return null;
        }
    }

    private function getAud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}