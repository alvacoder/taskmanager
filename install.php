<?php

if(isset($_POST['submit'])) {
    $dbhost = $_POST['hostname'];
    $dbuser = $_POST['username'];
    $dbpass = $_POST['password'];
    $dbname = $_POST['dbname'];

    //set up database
    try{
        $conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
        $query = "CREATE Database IF NOT EXISTS $dbname";
        $conn->query($query);

        //store database credentials into config file.
        $config = fopen('includes/Config.php', 'a');
        fwrite($config, '<?php');
        fwrite($config, "\n".'define("DSN", "mysql:host='.$dbhost.';database='.$dbname.'");');
        fwrite($config, "\n".'define("USERNAME", "'.$dbuser.'");');
        fwrite($config, "\n".'define("PASSWORD", "'.$dbpass.'");');
        fwrite($config, "\n".'$options = array("PDO::ATTR_PERSISTENT" => true);');
        fwrite($config, "\n\n".'?>');
        fclose($config);

        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", "$dbuser", "$dbpass");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "new db connected";

        //set up database tables
        $usersTableQuery = "CREATE TABLE IF NOT EXISTS users (
            id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(255) NOT NULL UNIQUE,
            email VARCHAR(255) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL UNIQUE,
            isactive INT(11) NOT NULL,
            isverified INT(11) NOT NULL,
            isadmin INT (11) NOT NULL,
            verifycode VARCHAR(11) NOT NULL,
            reg_date TIMESTAMP NOT NULL
        )";

        $tasksTableQuery = "CREATE TABLE IF NOT EXISTS tasks (
            id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            user_id INT(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            `desc` VARCHAR(255) NOT NULL,
            `status` VARCHAR(11) NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL
        )";
        
        $conn->query($usersTableQuery);
        $conn->query($tasksTableQuery);

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
            Database Host: <input type="text" name="hostname" id="" placeholder="Database host">
        </label><br/>
        <label for="username">
            Database Username: <input type="text" name="username" id="" placeholder="Database user">
        </label><br/>
        <label for="password">
            Database Password: <input type="password" name="password" id="" placeholder="Database password">
        </label><br/>
        <label for="dbname">
            Database Password: <input type="text" name="dbname" id="" placeholder="Give your new DB a name">
        </label><br/>
        <label for="submit">
            <input type="submit" name = "submit" value="Install Application">
        </label>
    </form>
</body>
</html>
