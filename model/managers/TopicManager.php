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
                SELECT t.* ,DATE_FORMAT(MAX(p.datePost, '%d/%m/%Y %H:%i')) AS lastMsg ,(SELECT COUNT(*) FROM post WHERE p.topic_id = t.id_topic) AS nbPost
                FROM topic t
                LEFT JOIN post p ON t.id_topic = p.topic_id
                WHERE t.categorie_id = :id
                ORDER BY lastMsg DESC";

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