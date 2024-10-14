<?php 
    $db_server = "localhost";
    $db_name = "service_sp";
    $db_username = "root";
    $db_password = "";
    try{
        $db_connect = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8", $db_username, $db_password);
        $db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
        
?>