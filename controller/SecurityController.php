<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\CategorieManager;

    class SecurityController extends AbstractController implements ControllerInterface{

        private array $categories;

        public function __construct(){
            $catManager = new CategorieManager();
            $this->categories = array($catManager->findAll(["nomCategorie", "ASC"]));
        }

        public function index(){}

        public function listUsers($id, $page){ // pour ce systeme de pagination il faut une variable id malgré le fait de ne pas l'utiliser
            $id = null;
            $userManager = new UserManager();
            
                if(Session::isAdmin()){
                    return [
                        "view" => VIEW_DIR."security\listUsers.php",
                        "data" => [
                            "categoriesMenu" => $this->categories,
                            "users" => $userManager->findAllEmail($id, $page, $_SESSION["nbElementsPerPage"]) // cette id est utiliser ici , + d'info sur UserManager.php
                        ]
                    ];
                }

        }

        public function login(){
            if(Session::getUser() == false){    
                return [
                    "view" => VIEW_DIR."security/login.php",
                    "data" => [
                    "categoriesMenu" => $this->categories
                ]];
            }
            else{
                Session::addFlash("error","vous êtes deja connecter.");
                $this->redirectTo("home");
            }
        }

        public function register(){
            if(Session::getUser() == false){
                return [
                    "view" => VIEW_DIR."security/register.php",
                    "data" => [
                        "categoriesMenu" => $this->categories
                    ]
                ];
            }
            else{
                Session::addFlash("error","vous êtes deja connecter.");
                $this->redirectTo("home");
            }
        }



        public function newRegister(){ // fonction nouvelle utilisateur
            
            // 1er methode fonctionnel mais incorrect

            // $userManager = new UserManager();

            // if(isset($_POST['submit'])){
                
            //     $allUsers1 = $userManager->findAll(["pseudo", "ASC"]);
            //     $allUsers2 = $userManager->findAll(["pseudo", "ASC"]);

            //     // sanitize + test si email deja existant

            //     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            //     $sameEmail = 0;
            //     $msgEmail = "";
            //     foreach($allUsers1 as $aUser){
            //         if($aUser->getEmail() == $email){
            //             $sameEmail = 1;
            //             $msgEmail = "<p>L'email est deja pris</p>";
            //         }
            //     }

            //     // sanitize + test si pseudo deja existant

            //     $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //     $samePseudo = 0;
            //     $msgPseudo = "";
            //     foreach($allUsers2 as $aUser){
            //         if($aUser->getPseudo() == $pseudo){
            //             $samePseudo = 1;
            //             $msgPseudo = "<p>Le pseudo est deja pris</p>";
            //         }
            //     }

            //     // assénissement des mots de passe + comparraison

            //     $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //     $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //     $notSamePassword = 0;
            //     $msgPassword = "";
            //     if($password1 != $password2){
            //         $notSamePassword = 1;
            //         $msgPassword = "<p>Les mots de passe sont differant</p>";
            //     }
            //     else{
            //         $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
            //     }
            //     $msg = $msgEmail.$msgPseudo.$msgPassword;
            //     if($email && $sameEmail == 0 && $pseudo && $samePseudo == 0 && $hashedPassword && $notSamePassword == 0){
            //         $userManager->add($data = [
            //             "password" => $hashedPassword ,
            //             "pseudo" => $pseudo ,
            //             "email" => $email 
            //         ]);
            //         $this->redirectTo("security","login");
            //     }

            // }

            // maniere prevue de base

            $userManager = new UserManager();

            if(isset($_POST['submit'])){
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($email && $pseudo && $password1){
                    // test mail BDD
                    if(!$userManager->findOnebyEmail($email)){
                        // test pseudo
                        if(!$userManager->findOnebyPseudo($pseudo)){
                            // test concordance des 2 mot de passe
                            if(strlen($password1)>8){
                                if($password1 == $password2){
                                    // mot de passe hasher
                                    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                                    $userManager->add($data = [
                                        "password" => $hashedPassword ,
                                        "pseudo" => $pseudo ,
                                        "email" => $email 
                                    ]);
                                    $this->redirectTo("security","login");
                                }
                                else{
                                    Session::addFlash("error","veuiller entrer correctement votre mot de passe");
                                    $this->redirectTo("security","register");
                                }    
                            }
                            else{
                                Session::addFlash("error","votre mot de passe est trop court");
                                $this->redirectTo("security","register");
                            }
                        }
                        else{
                            Session::addFlash("error","veuiller prendre un autre pseudo");
                            $this->redirectTo("security","register");
                        }
                    }
                    else{
                        Session::addFlash("error","veuiller prendre un autre email.");
                        $this->redirectTo("security","register");
                    }
                }
            }
        }

        public function loginTry(){ // fonction pour se connecter
            $userManager = new UserManager();
            if(isset($_POST['submit'])){
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL ,FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($email && $password){
                    if($userManager->findOnebyEmail($email)){
                        $user = $userManager->findOnebyEmail($email);
                        $hashed = $user->getPassword();
                        if(password_verify($password, $hashed)){
                            Session::setUser($user);
                            $this->redirectTo("forum","listTopics");
                        }
                        else{
                            Session::addFlash("error","veuiller rentrer le bon mot de passe");
                            $this->redirectTo("security","login");
                        }
                    }
                    else{
                        Session::addFlash("error","cette adresse email n'es pas lié a un utilisateur.");
                        $this->redirectTo("security","login");
                    }
                }
            }
        }

        public function logOut(){
            unset($_SESSION['user']);
            $this->redirectTo("home");
        }

    }