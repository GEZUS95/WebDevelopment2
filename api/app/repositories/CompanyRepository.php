<?php

namespace Repositories;

use models\Bedrijf;
use PDO;
use PDOException;

class CompanyRepository extends Repository
{
    public function checkUsernamePassword($username, $password)
    {
        try {
            // retrieve the user with the given username
            $stmt = $this->connection->prepare("SELECT id, name, password, email, role FROM bedrijven WHERE name = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Bedrijf::class);
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

    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM bedrijven");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Bedrijf::class);

            $users = $stmt->fetchAll();
            foreach ($users as $user) {
                $user->password = "";
            }
            return $users;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOne(string $email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM bedrijven WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Bedrijf::class);
            $user = $stmt->fetch();
            if ($user) {$user->password = "";}
            return $user;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(Bedrijf $bedrijf)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO bedrijven (name, role, email, password, phone, beschrijving, photo, logo) VALUES (:userName, :role ,:email, :password, :phone, :beschrijving, :foto, :logo)");

            $hashPassword = $this->hashPassword($bedrijf->password);
            $str = '';
            $stmt->bindParam(':userName', $bedrijf->name);
            $stmt->bindParam(':email', $bedrijf->email);
            $stmt->bindParam(':password', $hashPassword);
            $stmt->bindParam(':phone', $bedrijf->phone);
            $stmt->bindParam(':role', $bedrijf->role);
            $stmt->bindParam(':beschrijving', $bedrijf->beschrijving);
            $stmt->bindParam(':logo', $str);
            $stmt->bindParam(':foto', $str);

            $stmt->execute();
            return $this->getOneById($this->connection->lastInsertId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM bedrijven WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Bedrijf::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(Bedrijf $bedrijf)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE bedrijven SET name =:name, email = :email, password = :password, phone = :phone , beschrijving = :beschrijving, photo = :foto, logo = :logo WHERE id = :id");

            $hashPassword = $this->hashPassword($bedrijf->password);
            $str = '';
            $stmt->bindParam(':name', $bedrijf->name);
            $stmt->bindParam(':email', $bedrijf->email);
            $stmt->bindParam(':password', $hashPassword);
            $stmt->bindParam(':phone', $bedrijf->phone);
            $stmt->bindParam(':id', $bedrijf->id);
            $stmt->bindParam(':beschrijving', $bedrijf->beschrijving);
            $stmt->bindParam(':logo', $str);
            $stmt->bindParam(':foto', $str);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM bedrijven WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // hash the password (currently uses bcrypt)
    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // verify the password hash
    private function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }
}
