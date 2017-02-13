<?php

class user {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $mail;
    private $username;
    private $password;
    private $avatar;
    private $birthDate;
    private $rank;
    private $signupDate;
    
   // Construction de la classe
   public function __construct(array $donnees) {
       return $this->hydrate($donnees);
   }
    
    // Setters and getters
    public function get_id() {
        return $this->id;
    }
    
    public function set_id() {
         $this->id = $id;      
    }
    
    public function get_mail() {
        return $this->mail;
    }
    
    public function set_mail() {
         $this->mail = $mail;      
    }
    
    public function get_username() {
        return $this->username;
    }
    
    public function set_username() {
         $this->username = $username;      
    }
    
    public function get_password() {
        return $this->password;
    }
    
    public function set_password() {
         $this->password = $password;      
    }
    
    public function get_avatar() {
        return $this->avatar;
    }
    
    public function set_avatar() {
         $this->avatar = $avatar;      
    }
    
    public function get_birthDate() {
        return $this->birthDate;
    }
    
    public function set_birthDate() {
         $this->birthDate = $birthDate;      
    }
    
    public function get_rank() {
        return $this->rank;
    }
    
    public function set_rank() {
         $this->rank = $rank;      
    }
    
    public function get_signupDate() {
        return $this->signupDate;
    }
    
    public function set_signupDate() {
         $this->signupDate = $signupDate;      
    }

// Hydrate
public function hydrate(array $donnees) {
    foreach ($donnees as $key => $value) {
        // On récupère le nom du setter correspondant à l'attribut
        $method = 'set'. ucfirst($key);
        
        //Si le setter correspondant exite :
        if(method_exists($this, $method)) {
            // On appelle le setter
            $this->$method($value);
        }
}
}
    
}

?>