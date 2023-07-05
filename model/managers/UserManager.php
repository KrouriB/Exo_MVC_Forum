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

        public function findOnebyEmail($email){ // fonction utiliser pour tester la presence d'un email dans la base de donnée
            
            $sql = "
                SELECT *
                FROM ".$this->tableName." a
                WHERE a.email = :email";
                

            return $this->getOneOrNullResult(
                DAO::select($sql,[
                    'email'=>$email
                ],false),
                $this->className
            );
        }

        public function findAllUsers($id, $page, $nbElementsPerPage){ // fonction pour trouver tout les utilisateur ,nécessite $id dans variable d'entre sinon $page = NULL
            $page = ($page - 1) * $nbElementsPerPage;
            $limit = $page . ", " . $nbElementsPerPage;
            
            $sql = "
                SELECT *
                FROM ".$this->tableName." a
                LIMIT $limit";

            return $this->getMultipleResults(
                DAO::select($sql),
                $this->className
            );
        }

        public function countUsers(){
            $sql = "SELECT COUNT(id_user) AS total
                    FROM user";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        public function findOnebyPseudo($pseudo){ // fonction utiliser pour tester la presence d'un pseudo dans la base de donnée
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