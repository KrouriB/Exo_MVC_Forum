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

        public function findOnebyEmail($email){
            $sql = "
                SELECT *
                FROM ".$this->tableName." a
                WHERE a.email = :email";

            // var_dump($sql);die;

            return $this->getOneOrNullResult(
                DAO::select($sql,['email'=>$email],false),
                $this->className
            );
        }

    }