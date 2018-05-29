<?php

class Database{

	function getDB(){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = '';
		$dbname = "minicar";

		$mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
    //$dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass,$options); 
		$dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass); 
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbConnection;
	}
}




?>