<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){}
        
        public function listTopics(){
            
            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["dateCreation", "DESC"]),
                    "categories" => $categorieManager->findAll(["nomCategorie", "ASC"])
                ]
            ];

        }

        public function listCategories(){
            
            $categorieManager = new CategorieManager();
            
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nomCategorie", "ASC"])
                ]
            ];

        }

        public function listTopicsForACategorie(){
            
            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopicsForACategorie.php",
                "data" => [
                    "topics" => $topicManager->findTopicbyCategorie($_GET["id"]),
                    "categorie" => $categorieManager->findOneById($_GET["id"])
                ]
            ];

        }

        public function aTopic(){
            
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/aTopic.php",
                "data" => [
                    "posts" => $postManager->findPostsbyTopic($_GET["id"]),
                    "topic" => $topicManager->findOneById($_GET["id"])
                ]
            ];

        }

        public function aNewTopic(){

            $topicManager = new TopicManager();

            if (isset($_POST['submitNo'])){
                $topic = filter_input(INPUT_POST, "topic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $resume = filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($topic && $resume && $_POST['categorie'] != 0){
                    $topicManager->add($data = [
                        "nomTopic" => $topic,
                        "resumer" =>    $resume,
                        "categorie_id" => $_POST['categorie'],
                        "user_id" => $_SESSION['user']->getId()
                    ]);
                $this->redirectTo("forum","listTopics");
                }
            }
            elseif (isset($_POST['submitCate'])){
                $topic = filter_input(INPUT_POST, "topic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $resume = filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($topic && $resume){
                    $topicManager->add($data = [
                        "nomTopic" => $topic,
                        "resumer" =>    $resume,
                        "categorie_id" => $_GET['id'],
                        "user_id" => $_SESSION['user']->getId()
                    ]);
                    $this->redirectTo("forum","listTopicsForACategorie",$_GET['id']);
                }
            }

        }

        public function aPost(){

            $postManager = new PostManager();

            if (isset($_POST['submit'])){
                $message = filter_input(INPUT_POST, "messageForm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($message){
                    $postManager->add($data = [
                        "message" => $message,
                        "user_id" => $_SESSION['user']->getId(),
                        "topic_id" => $_GET['id']
                    ]);
                    $this->redirectTo("forum","aTopic",$_GET['id']);
                }
            }

        }

        public function addCategorie(){
            $categorieManager = new CategorieManager();
            if(isset($_POST['submit'])){
                $nomCategorie = filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($nomCategorie){
                    $categorieManager->add($data = ["nomCategorie" => $nomCategorie]);
                    $this->redirectTo("forum","listCategories");
                }
            }
        }

        public function verouillerTopic($id){
            $topicManager = new TopicManager();
            if(($topicManager->findOneById($id)->getUser() == Session::getUser()) OR Session::isAdmin()){ // ne pas mettre App\Session car deja appeler avant
                $topicManager->verouiller($id);
                $this->redirectTo("forum","aTopic",$id);
            }
        }

        public function listTopicsWithoutCategorie(){
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsWithoutCategorie.php",
                "data" => [
                    "topics" => $topicManager->findAll(["dateCreation", "DESC"])
                ]
            ];
        }

        public function aUser(){
            
            $userManager = new UserManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/aUser.php",
                "data" => [
                    "user" => $userManager->findOneById($_GET["id"]),
                    "topics" => $topicManager->findTopicbyUser($_GET["id"])
                ]
            ];

        }

        public function deleteCategorie($id){
            $categorieManager = new CategorieManager();
            $topicManager = new TopicManager();
            $topicManager->setIdTopic($id);
            $categorieManager->delete($id);
            $this->redirectTo("forum","listCategories");
        }

        public function deleteTopic($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $postManager->deleteMessagesTopic($id);
            $topicManager->delete($id);
            $this->redirectTo("forum","listTopics");
        }

        public function deleteMessage($id){
            $postManager = new PostManager();
            $postManager->delete($id);
            $this->redirectTo("forum","aTopic",$_GET['idTopic']);
        }
    }