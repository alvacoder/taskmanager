<?php
define("DSN","mysql:host=localhost;database=taskmgr");
define("USERNAME", "root");
define("PASSWORD", "");
$options = array('PDO::ATTR_PERSISTENT' => true);

    try {
        $conn = new PDO(DSN, USERNAME, PASSWORD, $options);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "db connected";
    } catch(PDOException $e) {
        $error = $e->getMessage();
        echo "Database error occured.";
    }
?>