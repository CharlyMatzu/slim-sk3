<?php namespace Src\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Src\Utils\JwtManager;

class AuthMiddleware
{
    private $jwtManager;
    public function __construct(JwtManager $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    // Funcionalidad de middleware
    public function __invoke(Request $req,  Response $res, $next)
    {
        $authorization = $req->getHeaderLine('Authorization');
        if (empty($authorization)) return $next($req, $res);

        $token = str_replace('Bearer ', '', $authorization);
        if (empty($token)) return $next($req, $res);

        $payload = $this->jwtManager->decodeToken($token);
        if (empty($user)) return $next($req, $res);

        $req = $req->withAttribute('payload', $payload);
        return $next($req, $res);
    }

    public function tokenParam(Request $req,  Response $res, $next) {
        $req->

        $payload = $this->jwtManager->decodeToken($token);
        if (empty($user)) return $next($req, $res);

        $req = $req->withAttribute('payload', $payload);
        return $next($req, $res);
     }
}