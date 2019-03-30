<?php
//connect to database
if(isset($_POST['submit'])) {
    $dbhost = $_POST['hostname'];
    $dbuser = $_POST['username'];
    $dbpass = $_POST['password'];

    try{
        $conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);

        $query = "CREATE Database IF NOT EXISTS taskmanager";
        $conn->query($query);
        echo 'Database connected';


    } catch(PDOException $e) {
        $error = $e->getMessage();
        echo 'Error occured while installing application.';
    }
    
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager Installer</title>
</head>
<body>
    <form action="install.php" name="install" method="post">
        <label for="host">
            <input type="text" name="hostname" id="" placeholder="Database host">
        </label><br/>
        <label for="username">
            <input type="text" name="username" id="" placeholder="Database user">
        </label><br/>
        <label for="password">
            <input type="text" name="password" id="" placeholder="Database password">
        </label><br/>
        <label for="username">
            <input type="submit" name = "submit" value="Install Application">
        </label>
    </form>
</body>
</html>