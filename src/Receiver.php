<?php
    class Receiver{
        private $firstname;
        private $lastname;
        private $username;
        private $password;
        private $blood_group;
        private $email;

        public function __construct($firstname, $lastname, $username, $password, $blood_group, $email){
            $this->firstname = $this->validateData($firstname);
            $this->lastname = $this->validateData($lastname);
            $this->password = $this->validateData($password);
            $this->username = $this->validateData($username);
            $this->blood_group = $this->validateData($blood_group);
            $this->email = $this->validateData($email);
        }

        public function getFirstName(){
            return $this->firstname;
        }

        public function getLastName(){
            return $this->lastname;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getBloodGroup(){
            return $this->blood_group;
        }

        public function getEmail(){
            return $this->email;
        }
        
        private function notNull($str){
            return $str != null and $str != '';
        }

        public function allValuesNotNull(){
            return $this->notNull($this->firstname) && $this->notNull($this->lastname) && $this->notNull($this->username)
                && $this->notNull($this->password) && $this->notNull($this->blood_group) && $this->notNull($this->email);
        }
        public function validateData($data){
            return htmlspecialchars(stripslashes(trim($data)));
        }
    }
?>