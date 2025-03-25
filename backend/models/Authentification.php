<?php

namespace backend\app;
use backend\exception\AuthentificationException as AuthentificationException;

class Authentification {
    /* une constante pour le niveau le plus bas */
    const ACCESS_LEVEL_NONE = -9999; 
  
    /* l'identifiant de l'utilisateur connecté */ 
    protected $user_login   = null;

    /* son niveau d'accès */
    protected $access_level = self::ACCESS_LEVEL_NONE; 

    /* vrai s'il est connecté */
    protected $logged_in    = false;


    /* un getter et un setter + toString */
    public function __get($attr_name) {
        if (property_exists( __CLASS__, $attr_name))
            return $this->$attr_name;
        $emess = __CLASS__ . ": unknown member $attr_name (__get)";
        throw new \Exception($emess);
    }

    public function __set($attr_name, $attr_val) {
        if (property_exists( __CLASS__, $attr_name)) 
            $this->$attr_name=$attr_val; 
        else{
            $emess = __CLASS__ . ": unknown member $attr_name (__set)";
            throw new \Exception($emess);
        }
    }

    public function __toString(){
        return json_encode(get_object_vars($this));
    } 


    public function __construct() {
        if(isset($_SESSION["user_login"])) {
            $this->user_login = $_SESSION["user_login"];
            $this->access_level = $_SESSION["access_level"];
            $this->logged_in = true;
        }
        else {
            $this->user_login = null;
            $this->access_level = Authentification::ACCESS_LEVEL_NONE;
            $this->logged_in = false;
        }
    }

    public function updateSession($username, $level) {
        $this->user_login = $username;
        $this->access_level = $level;

        $_SESSION["user_login"] = $username;
        $_SESSION["access_level"] = $level;

        $this->logged_in = true;
    }

    public function logout() {
        unset($_SESSION["user_login"]);
        unset($_SESSION["access_level"]);

        $this->user_login = null;
        $this->access_level = Authentification::ACCESS_LEVEL_NONE;
        $this->logged_in = false;
    }

    public function checkAccessRight($requested) {
        if($requested > $this->access_level) {
            return false;
        }
        else {
            return true;
        }
    }

    public function login($username, $db_pass, $given_pass, $level) {
        if(!$this->verifyPassword($given_pass, $db_pass)) {
            throw new AuthentificationException("Le mot de passe entré ne correspond pas");
        }
        else {
            $this->updateSession($username, $level);
        }
    }

    public function hashPassword($password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        return $password_hash;
    }

    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}

?>