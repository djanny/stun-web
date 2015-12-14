<?php

class Db {
  public static function Connection($dbname){
    $dbhost="localhost";
    $dbuser="web";
    $dbpass="secret";
      
    $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); 
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConnection;
    }
}
?>
