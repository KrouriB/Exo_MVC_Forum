<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopicbyCategorie($id){
            $sql = "
                SELECT *
                FROM ".$this->tableName." t
                WHERE t.categorie_id = :id
                ORDER BY dateCreation DESC";

            // var_dump($sql);die;

            return $this->getMultipleResults(
                DAO::select($sql,['id'=>$id]),
                $this->className
            );
            
        }

        public function verouiller($id){
            $sql = "
                UPDATE $this->tableName
                SET verouiller = 1
                WHERE id_topic = :id";

            // var_dump($sql);die;

            return $this->getOneOrNullResult(
                DAO::update($sql,['id'=>$id]),
                $this->className
            );
            
        }

        public function setIdTopic($id){
            $sql = "
                UPDATE $this->tableName
                SET categorie_id = NULL
                WHERE categorie_id = :id";

        // var_dump($sql);die;

        return $this->getOneOrNullResult(
            DAO::update($sql,['id'=>$id]),
            $this->className
        );
        }

    }