<?php
require_once 'includes/Config.php';
require_once 'includes/UserClass.php';

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $superUser = new UserClass;
    $superUser->superUserRegistration($username, $email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Root User Signup</title>
</head>
<body>
    <form action="superuser.php" method = "POST">
        <label for="username">
           Username: <input type="text" name="username" id=""><br/>
        </label>

        <label for="email">
           Email: <input type="email" name="email" id=""><br/>
        </label>

        <label for="password">
           Password: <input type="password" name="password" id=""><br/>
        </label>
        
        <label for="submit">
                <input type="submit" name = "submit" value="Sign Up">
        </label>
    </form>
</body>
</html>