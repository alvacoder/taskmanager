<?php

class UserClass
{
    
    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_PERSISTENT => true);
        
        try {
            $xconn = new PDO(DSN, USERNAME, PASSWORD, $options);
            $xconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'connected successfully';
        } catch(PDOException $e) {
            $error = $e->getMessage();
        }
        return $xconn;
    }
    

    public function superUserRegistration($username, $email, $password)
    {
        $xconn = $this->openDatabaseConnection();
        
        try {
            $newSuperUserQuery = "INSERT INTO users (username, email, password, isactive, isverified, isadmin, reg_date)
            VALUES (:username, :email, :password, '1', '1', '1', NOW())";
            $stmt = $xconn->prepare($newSuperUserQuery);
            $stmt->execute(array(':username'=>$username, ':email'=>$email, ':password'=>$password));
            echo 'Super User Created';
            $xconn = null;
            unlink('superuser.php');
        } catch(PDOException $e) {
            $error = $e->getMessage();
            exit('An error occured');
        }
        
    }

    public function userRegistration($username, $email, $password)
    {

    }

    public function userLogin($usernameEmail, $password)
    {

    }

    public function getUserProfile()
    {

    }

    public function editUserProfile($uid)
    {

    }

    public function changeUserPassword()
    {

    }

    public function resetUserPassword($uid)
    {

    }

    public function activateUserAccount($uid)
    {

    }
    
    public function deactivateUserAccount($uid)
    {

    }

    public function makeUserAdmin($uid)
    {

    }

    public function removeUserFromAdmin($uid)
    {

    }

    public function authCode()
    {

    }

    public function verificationCode()
    {

    }

    public function generateNewPassword()
    {

    }
}
