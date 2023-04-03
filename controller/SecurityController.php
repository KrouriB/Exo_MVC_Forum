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

        public function login(){
            return ["view" => VIEW_DIR."security/login.php"];
        }

        public function register(){
            return ["view" => VIEW_DIR."security/register.php"];
        }

        public function newRegister(){
            
            $userManager = new UserManager();

            if(isset($_POST['submit'])){
                
                $allUsers1 = $userManager->findAll(["pseudo", "ASC"]);
                $allUsers2 = $userManager->findAll(["pseudo", "ASC"]);

                // sanitize + test si email deja existant

                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $sameEmail = 0;
                $msgEmail = "";
                foreach($allUsers1 as $aUser){
                    if($aUser->getEmail() == $email){
                        $sameEmail = 1;
                        $msgEmail = "<p>L'email est deja pris</p>";
                    }
                }

                // sanitize + test si pseudo deja existant

                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $samePseudo = 0;
                $msgPseudo = "";
                foreach($allUsers2 as $aUser){
                    if($aUser->getPseudo() == $pseudo){
                        $samePseudo = 1;
                        $msgPseudo = "<p>Le pseudo est deja pris</p>";
                    }
                }

                // assénissement des mots de passe + comparraison

                $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $notSamePassword = 0;
                $msgPassword = "";
                if($password1 != $password2){
                    $notSamePassword = 1;
                    $msgPassword = "<p>Les mots de passe sont differant</p>";
                }
                else{
                    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                }
                $msg = $msgEmail.$msgPseudo.$msgPassword;
                if($email && $sameEmail == 0 && $pseudo && $samePseudo == 0 && $hashedPassword && $notSamePassword == 0){
                    $userManager->add($data = [
                        "password" => $hashedPassword ,
                        "pseudo" => $pseudo ,
                        "email" => $email 
                    ]);
                    $this->redirectTo("security","login");
                }

            }
        }

        public function loginTry(){
            if(isset($_POST['submit'])){
                
            }
        }
    }