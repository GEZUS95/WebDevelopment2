<?php

namespace Services;

use models\Bedrijf;
use Repositories\CompanyRepository;

class BedrijfService
{
    private CompanyRepository $repository;

    function __construct()
    {
        $this->repository = new CompanyRepository;
    }

    public function checkUsernamePassword($uname, $pass)
    {
        return $this->repository->checkUsernamePassword($uname, $pass);
    }

    public function getOneCompany(string $email)
    {
        return $this->repository->getOne($email);
    }

    public function getOneById(int $id)
    {
        $comp = $this->repository->getOneById($id);
        $comp->password = '';
        return $comp;
    }

    public function bedrijfExists($email)
    {
        if ($this->repository->getOne($email)) {
            return true;
        }
    }

    public function insertOne(Bedrijf $bedrijf)
    {
        if (!$this->bedrijfExists($bedrijf->email)) {
            $bedrijf->role = "Bedrijf";

            return $this->repository->insertOne($bedrijf);
        } else {
            return "Email already taken";
        }
    }

    public function updateOne(Bedrijf $bedrijf)
    {
        return $this->repository->updateOne($bedrijf);
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