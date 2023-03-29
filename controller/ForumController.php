<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){}
        
        public function listTopics(){
            
                $topicManager = new TopicManager();
                
                return [
                    "view" => VIEW_DIR."forum/listTopics.php",
                    "data" => [
                        "topics" => $topicManager->findAll(["dateCreation", "DESC"])
                    ]
                ];

        }

        public function listCategories(){
            
            $categorieManager = new CategorieManager();
            
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nomCategorie", "DESC"])
                ]
            ];

    }


        
    }