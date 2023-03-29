<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;

    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){}

        public function listUsers(){

            $userManager = new UserManager();
                
                return [
                    "view" => VIEW_DIR."admin/listUsers.php",
                    "data" => [
                        "users" => $userManager->findAll(["pseudo", "ASC"])
                    ]
                ];

        }
    }