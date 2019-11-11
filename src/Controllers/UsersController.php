<?php namespace Src\Controllers;

use Psr\Container\ContainerInterface;
use Src\Utils\Base;
use Src\Utils\HttpUtils;
use Src\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController extends Base
{
    private $httpUtils;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->httpUtils = $container->get('HttpUtils');
    }

    public function getUsers(Request $request, Response $response, $params = []){
        $users = User::get();
        return $response->write($users);
    }

    public function getUsersByName(Request $request, Response $response, $params = []){
        $users = User::where('firstName', $params['name'])->get();
        return $response->write($users);
    }

    public function addUser(Request $request, Response $response, $params = []){
        try{
            $body = $request->getParsedBody();
            // TODO: validate email existance
            User::create([
                'firstName' => $body['firstName'],
                'lastName' => $body['lastName'],
                'email' => $body['email']
            ]);
            return $this->httpUtils->makeMessageResponse($response, HttpUtils::OK, "Register Success");
        }catch (\Exception $ex){
            return $this->httpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Error: ".$ex->getMessage());
        }
    }

    public function updateUser(Request $request, Response $response, $params = []){
        try{
            $body = $request->getParsedBody();
            $id = $params['id'];
            // TODO: validate user id existance
            User::where('id', $id)
                ->update([
                    'firstName' => $body['firstName'],
                    'lastName' => $body['lastName'],
                    'email' => $body['email']
                ]);
            return $this->httpUtils->makeMessageResponse($response, HttpUtils::OK, "Update Success");
        }catch (\Exception $ex){
            return $this->httpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Error: ".$ex->getMessage());
        }
    }

    public function deleteUser(Request $request, Response $response, $params = []){
        try{
            $id = $params['id'];
            // TODO: validate user id existance
            $user = User::find($id);
            $user->delete();
            return $this->httpUtils->makeMessageResponse($response, HttpUtils::OK, "Delete Success");
        }catch (\Exception $ex){
            return $this->httpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Error: ".$ex->getMessage());
        }
    }
}