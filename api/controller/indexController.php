<?php 

class indexController {
    
    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new indexController();
        return self::$instance;
    }
    
    public static function index() {
        
    }
}

?>


