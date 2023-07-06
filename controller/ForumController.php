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

        private array $categories;

        public function __construct(){
            $catManager = new CategorieManager();
            $this->categories = array($catManager->findAll(["nomCategorie", "ASC"]));
        }

        public function index(){}
        
        public function listTopics(){
            
            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categoriesMenu" => $this->categories,
                    "topics" => $topicManager->findAll(["dateCreation", "DESC"]),
                    "categories" => $categorieManager->findAll(["nomCategorie", "ASC"])
                ]
            ];

        }

        public function listTopicsForACategorie($id, $page){
            
            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsForACategorie.php",
                "data" => [
                    "categoriesMenu" => $this->categories,
                    "total" => $topicManager->countTopicPerCategorie($id),
                    "topics" => $topicManager->findTopicbyCategorie($id, $page, $_SESSION["nbElementsPerPage"]),
                    "categorie" => $categorieManager->findOneById($id)
                ]
            ];
            

        }

        public function aTopic($id){
            
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/aTopic.php",
                "data" => [
                    "categoriesMenu" => $this->categories,
                    "posts" => $postManager->findPostsbyTopic($id),
                    "topic" => $topicManager->findOneById($id)
                ]
            ];

        }

        public function aNewTopic($id){

            $topicManager = new TopicManager();

            if(isset($_POST['submitNo'])){
                $topic = filter_input(INPUT_POST, "topic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $resume = filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($topic && $resume && $_POST['categorie'] != 0){
                    $topicManager->add($data = [
                        "nomTopic" => $topic,
                        "resumer" =>    $resume,
                        "categorie_id" => $_POST['categorie'],
                        "user_id" => $_SESSION['user']->getId()
                    ]);
                $this->redirectTo("forum","listTopics");
                }
                else{
                    Session::addFlash("error","veuiller remplir le formulaire correctement.");
                    $this->redirectTo("home");
                }
            }
            elseif(isset($_POST['submitCate'])){
                $topic = filter_input(INPUT_POST, "topic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $resume = filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($topic && $resume){
                    $topicManager->add($data = [
                        "nomTopic" => $topic,
                        "resumer" =>    $resume,
                        "categorie_id" => $id,
                        "user_id" => $_SESSION['user']->getId()
                    ]);
                    $this->redirectTo("forum","listTopicsForACategorie",$id,"1");
                }
                else{
                    Session::addFlash("error","veuiller remplir le formulaire correctement.");
                    $this->redirectTo("home");
                }
            }
        }

        public function addPost($id){

            $postManager = new PostManager();

            if (isset($_POST['submit'])){
                $message = filter_input(INPUT_POST, "messageForm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($message){
                    $postManager->add($data = [
                        "message" => $message,
                        "user_id" => $_SESSION['user']->getId(),
                        "topic_id" => $id
                    ]);
                    $this->redirectTo("forum","aTopic",$id);
                }
                else{
                    Session::addFlash("error","Vous ne pouvez pas envoyer un message vide.");
                    $this->redirectTo("forum","aTopic",$id,"1");
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
                else{
                    Session::addFlash("error","veuiller inserer un nom de categorie.");
                    $this->redirectTo("home");
                }
            }
        }

        public function verouillerTopic($id){

            $topicManager = new TopicManager();

            if(($topicManager->findOneById($id)->getUser() == Session::getUser()) OR Session::isAdmin()){ // ne pas mettre App\Session car deja appeler avant
                $topicManager->verouiller($id);
                Session::addFlash("success","vous avez verouiller le topic");
                $this->redirectTo("forum","aTopic",$id);
            }
            else{
                Session::addFlash("error","vous avez tentez de verouiller un topic qui ne vous appartient pas !");
                $this->redirectTo("home");
            }
        }

        public function listTopicsWithoutCategorie($id,$page){
            $id = 0;
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsWithoutCategorie.php",
                "data" => [
                    "categoriesMenu" => $this->categories,
                    "total" => $topicManager->countTopicPerCategorie($id),
                    "topics" => $topicManager->findTopicbyCategorie($id, $page, $_SESSION["nbElementsPerPage"])
                ]
            ];
        }

        public function aUser($id, $page){
            
            $userManager = new UserManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/aUser.php",
                "data" => [
                    "categoriesMenu" => $this->categories,
                    "user" => $userManager->findOneById($id),
                    "total" => $topicManager->countTopicPerUser($id),
                    "topics" => $topicManager->findTopicbyUser($id, $page, $_SESSION["nbElementsPerPage"])
                ]
            ];

        }

        public function deleteCategorie($id){

            $categorieManager = new CategorieManager();
            $topicManager = new TopicManager();

            if(Session::isAdmin()){
                $topicManager->setIdTopic($id);
                $categorieManager->delete($id);
                Session::addFlash("success","vous avez supprimer la categorie avec succès");
                $this->redirectTo("forum","listCategories");
            }
            else{
                Session::addFlash("error","vous n'avez pas l'autorisation pour supprimez une catégorie !");
                $this->redirectTo("home");
            }
        }

        public function deleteTopic($id){

            $topicManager = new TopicManager();
            $postManager = new PostManager();

            if(($topicManager->findOneById($id)->getUser() == Session::getUser()) OR Session::isAdmin()){
                $postManager->deleteMessagesTopic($id);
                $topicManager->delete($id);
                Session::addFlash("success","vous avez supprimer le topic avec succès");
                $this->redirectTo("forum","listTopics");
            }
            else{
                Session::addFlash("error","vous avez tenté de supprimer un topic qui ne vous appartient pas !");
                $this->redirectTo("home");
            }
        }

        public function deleteMessage($id){

            $postManager = new PostManager();
            $topicManager = new TopicManager();

            $postToDelete = $postManager->findOneById($id);
            
            if(($postToDelete->getUser() == Session::getUser()) || Session::isAdmin()){
                $postManager->delete($id);
                Session::addFlash("success","vous avez supprimer le message avec succès");
                $this->redirectTo("forum","aTopic",$postToDelete->getTopic()->getId());
            }
            else{
                Session::addFlash("error","vous avez tenté de supprimer un message qui ne vous appartient pas !");
                $this->redirectTo("home");
            }
        }
    }