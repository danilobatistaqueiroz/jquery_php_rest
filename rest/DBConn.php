<?php
include 'log/logger.php';

class DBConn {

	public static function getConn(){
		$host='localhost';
		$db = 'petshopdb';
		$username = 'petadm';
		$password = '123';

		$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";

		try{
			logToFile("create a PostgreSQL database connection");
			$conn = new PDO($dsn);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			//logToFile("display a message if connected to the PostgreSQL successfully");
			if($conn){
				logToFile("Connected to the <strong>$db</strong> database successfully!");
			}
			return $conn;
		}catch (PDOException $e){
			logToFile("report error message");
			logToFile($e->getMessage());
		}
	}
}
