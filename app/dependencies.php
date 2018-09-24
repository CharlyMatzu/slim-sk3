<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 20/08/2018
 * Time: 04:01 PM
 */


$container['RequestController'] = function($c){
    return new App\Controller\RequestController();
};

$container['AuthController'] = function($c){
    return new App\Controller\AuthController();
};
