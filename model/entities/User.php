<?php
        namespace Model\Entities;

        use App\Entity;

        final class User extends Entity{

                private $id;
                private $password;
                private $role;
                private $pseudo;
                private $email;

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
                 * Get the value of password
                 */ 
                public function getPassword()
                {
                        return $this->password;
                }

                /**
                 * Set the value of password
                 *
                 * @return  self
                 */ 
                public function setPassword($password)
                {
                        $this->password = $password;

                        return $this;
                }

                /**
                 * Get the value of role
                 */ 
                public function getRole()
                {
                        return $this->role;
                }

                /**
                 * Set the value of role
                 *
                 * @return  self
                 */ 
                public function setRole($role)
                {
                        $this->role = $role;

                        return $this;
                }

                /**
                 * Get the value of pseudo
                 */ 
                public function getPseudo()
                {
                        return $this->pseudo;
                }

                /**
                 * Set the value of pseudo
                 *
                 * @return  self
                 */ 
                public function setPseudo($pseudo)
                {
                        $this->pseudo = $pseudo;

                        return $this;
                }

                /**
                 * Get the value of email
                 */ 
                public function getEmail()
                {
                        return $this->email;
                }

                /**
                 * Set the value of email
                 *
                 * @return  self
                 */ 
                public function setEmail($email)
                {
                        $this->email = $email;

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

                public function hasRole($role): bool
                {
                        $result = $this->role == $role;
                        return $result;
                }

                public function __toString(){
                        return $this->getPseudo();
                }
        }
