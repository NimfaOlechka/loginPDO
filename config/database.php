<?php

/**
 * databsase connection
 */
class Database 
{

	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $charset;
	
	public $conn;
	
	public function getConnection() {
		$this->conn = null;
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "vsf";
		$this->charset = "utf8mb4";
		

		try {

			$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
			$this->conn = new PDO($dsn, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
			return $this->conn;
		} catch (PDOException $e) {
			echo $e->getMessage();
			die();
		}
		
	}

}
?>

