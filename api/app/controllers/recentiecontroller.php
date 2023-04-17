<?php

namespace Controllers;

use Exception;
use Services\RecentieService;

class RecentieController extends Controller
{
    private RecentieService $service;
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
            $this->respond($this->service->getAll());
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
                $this->respond($this->service->insertOne($post));
            } catch (Exception $e) {
                $this->respondWithError(500, $e->getMessage());
            }
        }
    }

    public function getOneById($id)
    {
        try {
            $this->respond($this->service->getOne($id));
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
                    $this->respond($this->service->deleteOne($id));
                } catch (Exception $e) {
                    $this->respondWithError(500, $e->getMessage());
                }
//            }
        }
    }
}
