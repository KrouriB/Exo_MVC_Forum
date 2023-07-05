<?php
        namespace Model\Entities;

        use App\Entity;

        final class Topic extends Entity{

                private $id;
                private $nomTopic;
                private $user;
                private $dateCreation;
                private $verouiller;
                private $categorie;
                private $resumer;
                private $nbPost;
                private $lastMsg;
                private $nbTopic;

                public function __construct($data){         
                        $this->hydrate($data);        
                }

                /**
                 * Get the value of id
                 */ 
                public function getId()
                {
                        return $this->id;
                }

                /**
                 * Set the value of id
                 *
                 * @return  self
                 */ 
                public function setId($id)
                {
                        $this->id = $id;

                        return $this;
                }

                /**
                 * Get the value of nomTopic
                 */ 
                public function getNomTopic()
                {
                        return $this->nomTopic;
                }

                /**
                 * Set the value of nomTopic
                 *
                 * @return  self
                 */ 
                public function setNomTopic($nomTopic)
                {
                        $this->nomTopic = $nomTopic;

                        return $this;
                }

                /**
                 * Get the value of user
                 */ 
                public function getUser()
                {
                        return $this->user;
                }

                /**
                 * Set the value of user
                 *
                 * @return  self
                 */ 
                public function setUser($user)
                {
                        $this->user = $user;

                        return $this;
                }

                public function getDateCreation(){
                $formattedDate = $this->dateCreation->format("d/m/Y, H:i:s");
                return $formattedDate;
                }

                public function setDateCreation($date){
                $this->dateCreation = new \DateTime($date);
                return $this;
                }

                /**
                 * Get the value of verouiller
                 */ 
                public function getVerouiller()
                {
                        return $this->verouiller;
                }

                /**
                 * Set the value of verouiller
                 *
                 * @return  self
                 */ 
                public function setVerouiller($verouiller)
                {
                        $this->verouiller = $verouiller;

                        return $this;
                }

                /**
                 * Get the value of categorie
                 */ 
                public function getCategorie()
                {
                        return $this->categorie;
                }

                /**
                 * Set the value of categorie
                 *
                 * @return  self
                 */ 
                public function setCategorie($categorie)
                {
                        $this->categorie = $categorie;

                        return $this;
                }

                /**
                 * Get the value of resumer
                 */ 
                public function getResumer()
                {
                        return $this->resumer;
                }

                /**
                 * Set the value of resumer
                 *
                 * @return  self
                 */ 
                public function setResumer($resumer)
                {
                        $this->resumer = $resumer;

                        return $this;
                }

                /**
                 * Get the value of nbPost
                 */ 
                public function getNbPost()
                {
                        return $this->nbPost;
                }

                /**
                 * Set the value of nbPost
                 *
                 * @return  self
                 */ 
                public function setNbPost($nbPost)
                {
                        $this->nbPost = $nbPost;

                        return $this;
                }

                /**
                 * Get the value of lastMsg
                 */ 
                public function getLastMsg()
                {
                        return $this->lastMsg;
                }

                /**
                 * Set the value of lastMsg
                 *
                 * @return  self
                 */ 
                public function setLastMsg($lastMsg)
                {
                        $this->lastMsg = $lastMsg;

                        return $this;
                }

                /**
                 * Get the value of nbTopic
                 */ 
                public function getNbTopic()
                {
                        return $this->nbTopic;
                }

                /**
                 * Set the value of nbTopic
                 *
                 * @return  self
                 */ 
                public function setNbTopic($nbTopic)
                {
                        $this->nbTopic = $nbTopic;

                        return $this;
                }

                /**
                 * Get the value of total
                 */ 
                public function getTotal()
                {
                        return $this->total;
                }

                /**
                 * Set the value of total
                 *
                 * @return  self
                 */ 
                public function setTotal($total)
                {
                        $this->total = $total;

                        return $this;
                }
        }
