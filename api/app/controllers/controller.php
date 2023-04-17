<?php

namespace Controllers;

use Exception;
use Helpers\AuthHelper;

class Controller
{
    protected AuthHelper $auth;

    public function __construct()
    {
        $this->auth = new AuthHelper();
    }

    public function respond($data)
    {
        $this->respondWithCode(200, $data);
    }

    public function respondWithError($httpcode, $message)
    {
        $data = array('errorMessage' => $message);
        $this->respondWithCode($httpcode, $data);
    }

    private function respondWithCode($httpcode, $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpcode);
        echo json_encode($data);
    }

    public function createObjectFromPostedJson($className)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $object = new $className();
        foreach ($data as $key => $value) {
            if(is_object($value)) {
                continue;
            }
            $object->{$key} = $value;
        }
        return $object;
    }
}
