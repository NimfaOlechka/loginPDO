<?php
/**
 * Uddannelse
 */
class Uddannelse 
{
	
	// database connection and table name
    private $conn;
    private $table_name = "uddannelse";
 
    // object properties
    public $udd_uid;
    public $udd_title;
    public $created;
    public $modified;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

	// read all records from table
    public function read(){
    	
	    $query = "SELECT
	                udd_uid,
	                udd_title,
	                created,
	                modified	                
	            FROM " . $this->table_name . "
	            ORDER BY udd_uid DESC";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare( $query );	   
	 
	    // execute query
	    $stmt->execute();
	 
	    // return values
	    return $stmt;
    }
    // used to read category name by its ID
    function readName(){
         
        $query = "SELECT udd_title FROM " . $this->table_name . " WHERE udd_uid = ? limit 0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->udd_uid);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $this->udd_title = $row['udd_title'];
    } 
}
?>