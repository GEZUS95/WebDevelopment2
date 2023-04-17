<?php

namespace Services;

use models\User;
use Repositories\UserRepository;

class UserService
{

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository;
    }

    public function checkUsernamePassword($uname, $pass)
    {
        return $this->repository->checkUsernamePassword($uname, $pass);
    }

    public function getOneUser(string $email)
    {
        return $this->repository->getOne($email);
    }

    public function getOneById(int $id)
    {
        $user = $this->repository->getOneById($id);
        $user->password = "";
        return $user;
    }

    public function userExists($email)
    {
        if ($this->repository->getOne($email)) {
            return true;
        }
    }

    public function insertOne(User $user)
    {
        if (!$this->userExists($user->email)) {
            $user->role = "User";
            return $this->repository->insertOne($user);
        } else {
            return "Email already taken";
        }
    }

    public function updateOne(user $user)
    {
        return $this->repository->updateOne($user);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function deleteOne(int $id)
    {
        return $this->repository->deleteOne($id);
    }
}