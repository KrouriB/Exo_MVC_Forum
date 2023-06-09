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

        public function findTopicbyCategorie($id, $page, $nbElementsPerPage){
            $page = ($page - 1) * $nbElementsPerPage;
            $limit = $page . ", " . $nbElementsPerPage;
            
            $sql = "
                SELECT t.* ,MAX(DATE_FORMAT(p.datePost, '%d/%m/%Y %H:%i')) AS lastMsg ,(SELECT COUNT(p.topic_id) FROM post p WHERE p.topic_id = t.id_topic) AS nbPost
                FROM topic t
                LEFT JOIN post p ON t.id_topic = p.topic_id
                WHERE t.categorie_id = :id
                GROUP BY t.id_topic
                ORDER BY lastMsg DESC
                LIMIT $limit";

            return $this->getMultipleResults(
                DAO::select($sql,[
                    'id'=>$id
                ]),
                $this->className
            );
            
        }

        public function findTopicbyUser($id, $page, $nbElementsPerPage){
            $page = ($page - 1) * $nbElementsPerPage;
            $limit = $page . ", " . $nbElementsPerPage;
            
            $sql = "
                SELECT t.* ,(SELECT COUNT(p.topic_id) FROM post p WHERE p.topic_id = t.id_topic) AS nbPost,(SELECT COUNT(t.user_id) FROM topic t WHERE t.user_id = :id) AS nbTopic
                FROM topic t
                LEFT JOIN post p ON t.id_topic = p.topic_id
                WHERE t.user_id = :id
                GROUP BY t.id_topic
                ORDER BY t.dateCreation DESC
                LIMIT $limit";
                // var_dump($page ,"<br>", $nbElementsPerPage,"<br>",$sql);die;

            return $this->getMultipleResults(
                DAO::select($sql,[
                    'id'=>$id
                ]),
                $this->className
            );
            
        }

        public function countTopicPerUser($id){
            $sql = "SELECT COUNT(id_topic) AS total
                    FROM topic
                    WHERE user_id = :id";

            return $this->getMultipleResults(
                DAO::select($sql,[
                    'id'=>$id
                ]), 
                $this->className
            );
        }

        public function countTopicPerCategorie($id){
            $sql = "SELECT COUNT(id_topic) AS total
                    FROM topic
                    WHERE categorie_id = :id";

            return $this->getMultipleResults(
                DAO::select($sql,[
                    'id'=>$id
                ]), 
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
                SET categorie_id = 0
                WHERE categorie_id = :id";

        // var_dump($sql);die;

        return $this->getOneOrNullResult(
            DAO::update($sql,['id'=>$id]),
            $this->className
        );
        }

    }