<?php

namespace Services;

use models\ReactieDTO;
use models\Recentie;
use Repositories\RecentieRepository;

class RecentieService
{
    private RecentieRepository $repository;

    public function __construct()
    {
        $this->repository = new RecentieRepository;
    }

    public function getAll()
    {

        return $this->repository->getAll();
    }

    public function insertOne(Recentie $review)
    {
        return $this->repository->insertOne($review);
    }

    public function getOne($id)
    {
        return $this->repository->getOne($id);
    }

    public function addReaction(int $id, ReactieDTO $reaction)
    {
        return $this->repository->addReaction($id, $reaction);
    }

    public function deleteOne(int $id)
    {
        return $this->repository->deleteOne($id);
    }
}
