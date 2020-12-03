<?php
class Hospital{
    private $userid;
    private $password;
    private $name;
    private $address;
    
    public function __construct($userid, $password, $name, $address){
        $this->userid = $this->validateData($userid);
        $this->password = $this->validateData($password);
        $this->name = $this->validateData($name);
        $this->address = $this->validateData($address);
    }
    public function getUserid(){
        return $this->userid;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getName(){
        return $this->name;
    }
    public function getAddress(){
        return $this->address;
    }

    private function notNull($str){
        return $str != null and $str != '';
    }

    public function allValuesNotNull(){
        return $this->notNull($this->name) && $this->notNull($this->userid)
            && $this->notNull($this->password) && $this->notNull($this->address);
    }
    public function validateData($data){
        return htmlspecialchars(stripslashes(trim($data)));
    }
}

?>