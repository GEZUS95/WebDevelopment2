<?php

namespace Repositories;

use Models\ReactieDTO;
use Models\Recentie;
use PDO;
use PDOException;

class RecentieRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM recenties");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Recentie::class);

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM recenties WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Recentie::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(Recentie $review)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO recenties (companyId, userId, title, description, rating, reaction) VALUES (:companyId, :userId, :title, :description, :rating, :reaction)");

            $stmt->bindParam(':companyId', $review->companyId);
            $stmt->bindParam(':userId', $review->userId);
            $stmt->bindParam(':title', $review->title);
            $stmt->bindParam(':description', $review->description);
            $stmt->bindParam(':rating', $review->rating);
            $stmt->bindParam(':reaction', $review->reaction);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function addReaction(int $id, ReactieDTO $reaction)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE recenties SET reaction = :react WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':react', $reaction->beschrijving);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Recentie::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM recenties WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}