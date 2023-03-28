<?php

    namespace App;

    abstract class AbstractController{

        public function index(){}

        public function redirectTo($ctrl = null, $action = null, $id = null){
        // fonction generallement native dans des framework pour faire des redirection 
            if($ctrl != "home"){
                $url = $ctrl ? "/".$ctrl : "";
                $url .= $action ? "/".$action : "";
                $url .= $id ? "/".$id : "";
                $url .= ".html";
            }
            else $url = "/";
            header("Location: $url");
            die();
        }

        public function restrictTo($role){
        //  fonction pour restraindre l'acces seulement a certain utilisateur
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("security","login");
            }
        return;
        }
    }