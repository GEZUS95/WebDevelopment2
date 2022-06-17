<?php

namespace Controllers;

use Exception;
use Services\RecentieService;

class RecentieController extends Controller
{
    private $service;
    private const NLI = "Not Logged In";

    // initialize services
    function __construct()
    {
        parent::__construct();
        $this->service = new RecentieService();
    }

    public function getAll()
    {
        try {
            $res = $this->service->getAll();
            $this->respond($res);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function createOne()
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {
            try {
                $post = $this->createObjectFromPostedJson("Models\\Recentie");
                $res = $this->service->insertOne($post);
                $this->respond($res);
            } catch (Exception $e) {
                $this->respondWithError(500, $e->getMessage());
            }
        }
    }

    public function getOneById($id)
    {
        try {
            $res = $this->service->getOne($id);
            $this->respond($res);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function react($id)
    {
        if (!$this->auth->checkAuthorization()) {
            $this->respondWithError(401, self::NLI);
        } else {
            try {
                $post = $this->createObjectFromPostedJson("Models\\ReactieDTO");
                $this->service->addReaction($id, $post);
            } catch (Exception $e) {
                $this->respondWithError(500, $e->getMessage());
            }
        }
    }

    public function deleteOne($id)
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
}
