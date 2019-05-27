<?php namespace App\Controllers;


use App\Classes\HttpUtils;
use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController extends BaseController
{
    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function getUsers($request,  $response, $params = []){
        // $this->container
        $users = User::get();
        return $response->write($users);
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function getUsersByName($request,  $response, $params = []){
        $users = User::where('firstName', $params['name'])->get();
        return $response->write($users);
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function addUser($request,  $response, $params = []){
        try{
            $body = $request->getParsedBody();
            // TODO: validate email existance
            User::create([
                'firstName' => $body['firstName'],
                'lastName' => $body['lastName'],
                'email' => $body['email']
            ]);
            return $this->container->HttpUtils->makeMessageResponse($response, HttpUtils::OK, "Register Success");
        }catch (\Exception $ex){
            return $this->container->HttpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Error: ".$ex->getMessage());
        }
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function updateUser($request,  $response, $params = []){
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
            return $this->container->HttpUtils->makeMessageResponse($response, HttpUtils::OK, "Update Success");
        }catch (\Exception $ex){
            return $this->container->HttpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Error: ".$ex->getMessage());
        }
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function deleteUser($request,  $response, $params = []){
        try{
            $id = $params['id'];
            // TODO: validate user id existance
            $user = User::find($id);
            $user->delete();
            return $this->container->HttpUtils->makeMessageResponse($response, HttpUtils::OK, "Delete Success");
        }catch (\Exception $ex){
            return $this->container->HttpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Error: ".$ex->getMessage());
        }
    }
}