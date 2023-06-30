<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function findOnebyEmail($email,/*$page*/){
            /*$page = ($page - 1) * 5;*/
            $sql = "
                SELECT *
                FROM ".$this->tableName." a
                WHERE a.email = :email";
                /*
                LIMIT :page, 5*/

            return $this->getOneOrNullResult(
                DAO::select($sql,[
                    'email'=>$email/*,
                    'page'=>$page*/
                ],false),
                $this->className
            );
        }

        public function findOnebyPseudo($pseudo){
            $sql = "
                SELECT *
                FROM ".$this->tableName." a
                WHERE a.pseudo = :pseudo";

            // var_dump($sql);die;

            return $this->getOneOrNullResult(
                DAO::select($sql,['pseudo'=>$pseudo],false),
                $this->className
            );
        }

    }