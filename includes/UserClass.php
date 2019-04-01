<?php
require_once 'Config.php';

class UserClass
{
    public function __construct()
    {
        try {
            $xconn = new PDO(DSN, USERNAME, 'PASSWORD');
            $xconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $error = $e->getMessage();
            die('An error occured.');
        }
    }

    public function registerUser()
    {
        
    }
    
}