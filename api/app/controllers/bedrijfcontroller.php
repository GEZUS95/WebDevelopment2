<?php

namespace Controllers;

use Exception;
use Services\BedrijfService;


class BedrijfController extends Controller
{
    private BedrijfService $service;
    private const MODEL = "Models\\Bedrijf";
    private const NCU = "Not the correct user";
    private const NLI = "Not Logged In";

    // initialize services
    public function __construct()
    {
        parent::__construct();
        $this->service = new BedrijfService();
    }

    public function login()
    {
        try {
            $postedCompany = $this->createObjectFromPostedJson(self::MODEL);

            $Company = $this->service->checkUsernamePassword($postedCompany->username, $postedCompany->password);

            if (!$Company) {
                $this->respondWithError(401, "Invalid Credentials");
                return;
            }

            $this->respond(['token' => $this->auth->generateJWT($Company)]);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function getAllCompanys()
    {
        try {
            $this->respond($this->service->getAll());
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function createCompany()
    {
        try {
            $postedCompany = $this->createObjectFromPostedJson(self::MODEL);
            $this->respond($this->service->insertOne($postedCompany));
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

    }

    public function updateCompany()
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {

            try {
                $postedCompany = $this->createObjectFromPostedJson(self::MODEL);
//                if ($this->auth->checkAuthorization()->id != $postedCompany->id) {
//                    $this->respondWithError(403, self::NCU);
//                } else {
                    $this->service->updateOne($postedCompany);
                    $this->respond($postedCompany);

            } catch (Exception $e) {
                $this->respondWithError(500, $e->getMessage());
            }

        }
    }

    public function getOneById($id)
    {
        try {
            $this->respond($this->service->getOneById($id));
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function deleteCompany($id)
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {
//            if (!$this->auth->isRole("Admin")) {
//                $this->respondWithError(403, "Not the correct role");
//            } else {
                try {
                    $this->respond($this->service->deleteOne($id));
                } catch (Exception $e) {
                    $this->respondWithError(500, $e->getMessage());
                }
//            }
        }
    }

    public function getCurrentCompany()
    {
        $check = $this->auth->checkAuthorization();
        $this->respond(["user" => $this->service->getOneById($check->data->id)]);
    }
}
