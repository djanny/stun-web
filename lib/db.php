<?php

require_once('../config/config.php');

class DB {
	public static function getRestDBConnection() {
		return DB::getConnection(DB_HOST_REST, DB_USER_REST, DB_PASS_REST, DB_REST_NAME);
	}

	public static function getLtcDBConnection() {
		return DB::getConnection(DB_HOST_LTC, DB_USER_LTC, DB_PASS_LTC, DB_LTC_NAME);
	}	
	
	public static function getConnection($dbhost, $dbuser, $dbpass, $dbname) {
		$db_uri = "mysql:host=$dbhost;dbname=$dbname";
		$dbConnection = new PDO ( $db_uri, $dbuser, $dbpass, array (
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'" 
		) );
		$dbConnection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		return $dbConnection;
	}
}
?>
