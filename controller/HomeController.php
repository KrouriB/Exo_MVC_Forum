<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        private array $categories;

        public function __construct(){
            $catManager = new CategorieManager();
            $this->categories = array($catManager->findAll(["nomCategorie", "ASC"]));
        }

        public function index(){
            
                return [
                    "view" => VIEW_DIR."home.php",
                    "data" => [
                        "categoriesMenu" => $this->categories
                    ]
                ];
            }

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php",
                "data" => [
                    "categoriesMenu" => $this->categories
                ]
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
