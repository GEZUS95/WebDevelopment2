<?php

namespace Repositories;

use Models\User;
use PDO;
use PDOException;

class UserRepository extends Repository
{
    function checkUsernamePassword($username, $password)
    {
        try {
            // retrieve the user with the given username
            $stmt = $this->connection->prepare("SELECT id, name, password, email, role FROM users WHERE name = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $user = $stmt->fetch();

            // verify if the password matches the hash in the database
            $result = $this->verifyPassword($password, $user->password);

            if (!$result) {
                return false;
            }

            // do not pass the password hash to the caller
            $user->password = "";

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);

            $users = $stmt->fetchAll();

            foreach ($users as $user){
                $user->password = "";
            }

            return $users;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne(string $email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $user = $stmt->fetch();

            $user->password = "";
            return $user;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insertOne(user $user)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users (name, role, email, password, phone) VALUES (:userName, :role ,:email, :password, :phone)");

            $hashPassword = $this->hashPassword($user->password);

            $stmt->bindParam(':userName', $user->name);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':password', $hashPassword);
            $stmt->bindParam(':phone', $user->phone);
            $stmt->bindParam(':role', $user->role);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $user = $stmt->fetch();
            $user->password = "";
            return $user;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateOne(user $user)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE users SET name =:name, email = :email, password = :password, phone = :phone WHERE id = :id");

            $hashPassword = $this->hashPassword($user->password);

            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':password', $hashPassword);
            $stmt->bindParam(':phone', $user->phone);
            $stmt->bindParam(':id', $user->id);


            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // hash the password (currently uses bcrypt)
    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // verify the password hash
    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }
}