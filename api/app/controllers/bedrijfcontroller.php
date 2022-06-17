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
    function __construct()
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
            $res = $this->service->getAll();
            $this->respond($res);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function createCompany()
    {
        try {
            $postedCompany = $this->createObjectFromPostedJson(self::MODEL);
            $res = $this->service->insertOne($postedCompany);
            $this->respond($res);
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
                    $res = $this->service->updateOne($postedCompany);
                    $this->respond($res);

            } catch (Exception $e) {
                $this->respondWithError(500, $e->getMessage());
            }

        }
    }

    public function getOneById($id)
    {
        try {
            $res = $this->service->getOneById($id);
            $this->respond($res);
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
                    $res = $this->service->deleteOne($id);
                    $this->respond($res);
                } catch (Exception $e) {
                    $this->respondWithError(500, $e->getMessage());
                }
//            }
        }
    }

    public function getCurrentCompany()
    {
        $check = $this->auth->checkAuthorization();
        return $this->respond(["user" => $this->service->getOneById($check->data->id)]);
    }
}
