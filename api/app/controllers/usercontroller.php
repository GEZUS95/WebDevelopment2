<?php

namespace Controllers;

use Exception;
use Services\UserService;


class UserController extends Controller
{
    private UserService $service;
    private const MODEL = "Models\\User";

    private const NCR = "Not the correct role";
    private const NCU = "Not the correct user";
    private const NLI = "Not Logged In";

    // initialize user service
    function __construct()
    {
        parent::__construct();
        $this->service = new UserService();
    }

    public function login()
    {
        try {
            $postedUser = $this->createObjectFromPostedJson(self::MODEL);

            $user = $this->service->checkUsernamePassword($postedUser->username, $postedUser->password);
            if (!$user) {
                $this->respondWithError(401, "Invalid Credentials");
                return;
            }

            $this->respond(['token' => $this->auth->generateJWT($user)]);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function getAllUsers()
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {
            if (!$this->auth->isRole("Admin")) {
                $this->respondWithError(403, self::NCR);
            } else {
                try {
                    $res = $this->service->getAll();
                    $this->respond($res);
                } catch (Exception $e) {
                    $this->respondWithError(500, $e->getMessage());
                }
            }
        }
    }

    public function createUser()
    {
        try {
            $postedUser = $this->createObjectFromPostedJson(self::MODEL);
            $res = $this->service->insertOne($postedUser);
            $this->respond($res);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

    }

    public function updateUser()
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {
            if (!$this->auth->isRole("User")) {
                $this->respondWithError(403, self::NCR);
            } else {
                try {
                    $postedUser = $this->createObjectFromPostedJson(self::MODEL);
                    if (($this->auth->checkAuthorization()->data->id !== $postedUser->id)) {
                        $this->respondWithError(403, self::NCU);
                    } else {
                        $res = $this->service->updateOne($postedUser);
                        $this->respond($res);
                    }
                } catch (Exception $e) {
                    $this->respondWithError(500, $e->getMessage());
                }
            }
        }
    }

    public function getOneById($id)
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {
            try {
                $res = $this->service->getOneById($id);
                $this->respond($res);
            } catch (Exception $e) {
                $this->respondWithError(500, $e->getMessage());
            }
        }
    }

    public function deleteUser($id)
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {
//            if ((!$this->auth->isRole("Admin")) || (!$this->auth->isRole("User"))) {
//                $this->respondWithError(403, self::NCR);
//            } else {
                try {
                    $res = $this->service->deleteOne($id);
                    $this->respond($res);
                } catch (Exception $e) {
                    $this->respondWithError(500, $e->getMessage());
                }
//            }
        }
    }

    public function getCurrentUser()
    {
        $check = $this->auth->checkAuthorization();
        return $this->respond(["user" => $this->service->getOneById($check->data->id)]);
    }
}

