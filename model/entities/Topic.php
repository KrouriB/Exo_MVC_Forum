<?php
        namespace Model\Entities;

        use App\Entity;

        final class Topic extends Entity{

                private $id;
                private $nomTopic;
                private $user;
                private $dateCreation;
                private $verouiller;
                private $categorie

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
        }
