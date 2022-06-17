<?php

namespace Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Services\UserService;

class AuthHelper
{
    private const PRIVATEKEY = "eindopdracht_key";
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }


    public function checkAuthorization()
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])){
            return false;
        }

        $head = $_SERVER['HTTP_AUTHORIZATION'];

        $arr = explode(" ", $head);
        $jwt = $arr[1];

        return $this->decodeJWT($jwt);
    }

    public function generateJWT($user)
    {
        $payload = array(
            "iss" => "http://localhost",
            "aud" => "http://localhost",
            "iat" => time(),
            "nbf" => time(),
            "exp" => time() + 600000,
            "data" => array(
                "id" => $user->id,
                "username" => $user->name,
                "email" => $user->email,
                "role" => $user->role
            )
        );

        return JWT::encode($payload, self::PRIVATEKEY, 'HS256');
    }

    private function decodeJWT($jwt)
    {
        try {
            return JWT::decode($jwt, new Key(self::PRIVATEKEY, 'HS256'));
        } catch (\Exception $e){
            return $e;
        }
    }

    public function isRole($role): bool
    {
        $decoded = $this->checkAuthorization();
        $user = $this->userService->getOneById($decoded->data->id);
        return $user->role === $role;
    }
}