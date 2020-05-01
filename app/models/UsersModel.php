<?php

class UsersModel extends Db{
    public function __construct()
    {
        parent::__construct();
    }

    private function setCookie($id,$hash)
    {
        setcookie("user[id]", $id, time()+3600,"/");
        setcookie("user[hash]", $hash, time()+3600,"/");
    }
    
    private function deleteCookie()
    {
        setcookie("user[id]", "", time()-3600*60,"/");
        setcookie("user[hash]", "", time()-3600*60,"/");
    }

    private function setHash($hash,
                             $user_id)
    {
        $this->db->query("UPDATE users SET hash=".$this->db->quote($hash)." WHERE id=".$this->db->quote($user_id));
    }

    public function checkCookie()
    {
        if(empty($_COOKIE["user"]))
            return false;
        $id = $_COOKIE["user"]["id"]*1;
        $hash =  $_COOKIE["user"]["hash"];
        if(is_int($id) && !strpos($hash," "))
            if($user = $this->getUserById($id))
                if($user["hash"] == $hash)
                    return true;
        
        $this->deleteCookie();
        return false;
    }
    
    public function getUserById($id){
        return $this->db->query("SELECT * FROM users WHERE id=".$this->db->quote($id))->fetch();
    }

    private function getHash(){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        $salt = '';
        for ($i = 0; $i < rand(1, 40); $i++) {
          $salt .= substr($chars, rand(1, $numChars) - 1, 1);
          $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return crypt($string,$salt);
    }
    
    public function login($name,$password){
        $user = $this->db->query("SELECT * FROM users WHERE name=".$this->db->quote($name)." 
                                                        AND password=".$this->db->quote($password))->fetch();
        if($user){
            $new_hash = $this->getHash();
            $this->db->query("UPDATE users SET hash=".$this->db->quote($new_hash)." WHERE id=".$this->db->quote($user["id"]));
            $this->setCookie($user["id"],$new_hash);
            return true;
        }else
            return false;
    }

    public function logout(){
        $this->setHash("",$_COOKIE["user"]["id"]);
        $this->deleteCookie();
    }
}