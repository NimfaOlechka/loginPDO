<?php

/**
 * Fag
 */
class Fag
{
	// database connection and table name
    private $conn;
    private $table_name = "fag";
    private $table_name2 = "udd_og_fag";
    //object properties
    //public $id;
	public $fag_uid;
	public $fag_title;
	public $startdato;
	public $enddato;
	public $created;

	//uddannelse property shoud hold chosen values
	public $udd_uid = [];
	public $udd_title = [];

	public function __construct($db){
        $this->conn = $db;
    }

    //function to show errors if action over object is not succeed
	public function showError($stmt){
	    echo "<pre>";
	        print_r($stmt->errorInfo());
	    echo "</pre>";
	}

	//function to check if record already exist in table
	public function fagExist()
	{
		// query to check if email exists
	    $query = "SELECT fag_uid, 
	    				 fag_title,
	    				 startdato,
	    				 enddato
	            FROM " . $this->table_name . "
	            WHERE fag_uid = ?";
	 
	    // prepare the query
	    $stmt = $this->conn->prepare( $query );
	 
	    // sanitize
	    $this->fag_uid=htmlspecialchars(strip_tags($this->fag_uid));
	 
	    // bind given email value
	    $stmt->bindParam(1, $this->fag_uid);
	 
	    // execute the query
	    $stmt->execute();
	 
	    // get number of rows
	    $num = $stmt->rowCount();
	 
	    // if fag exists, assign values to object properties for edit use for php sessions
	    if($num>0){
	 
	        // get record details / values
	        $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	        // assign values to object properties
	        $this->fag_uid = $row['fag_uid'];
	        $this->fag_title = $row['fag_title'];
	        $this->startdato = $row['startdato'];
	        $this->enddato = $row['enddato'];
	 
	        // return true because fag exists in the database
	        return true;
	    }
	 
	    // return false if fag does not exist in the database
	    return false;
		
	}

    public function create()
    {
    	//insert query
    	$query = "INSERT INTO
	                " . $this->table_name . "
	            SET
	                fag_uid = :fag_uid,
	                fag_title = :fag_title,
	                startdato = :startdato,
	                enddato = :enddato";

	    // prepare the query
	    $stmt = $this->conn->prepare($query);

	    // sanitize
	    $this->fag_uid= htmlspecialchars(strip_tags($this->fag_uid));
	    $this->fag_title=htmlspecialchars(strip_tags($this->fag_title));
	    $this->startdato= htmlspecialchars(strip_tags($this->startdato));
	    $this->enddato = htmlspecialchars(strip_tags($this->enddato));

	    // bind the values
	    $stmt->bindParam(':fag_uid', $this->fag_uid);
	    $stmt->bindParam(':fag_title', $this->fag_title);
	    $stmt->bindParam(':startdato', $this->startdato);
	    $stmt->bindParam(':enddato', $this->enddato);
	   
	    // execute the query, also check if query was successful
	    if($stmt->execute()){
	        return true;
	    }else{
	        $this->showError($stmt);
	        return false;
	    }
    }


    public function setUddannelse()
    {
    	echo "<script>alert('".$this->udd_uid[0]."')</script>";

    	for ($count=0; $count < count($this->udd_uid); $count++) { 
		
			//insert query
	    	$query = "INSERT INTO
		                " . $this->table_name2 . "
		            SET
		                fag_id = :fag_uid,
		                udd_id = :udd_uid";
		    // prepare the query
		    $stmt = $this->conn->prepare($query);
		    // execute the query
		    $stmt->execute(
			array(			
			':udd_uid' => $this->udd_uid[$count],
			':fag_uid' => $this->fag_uid
			)
		);
	        
		}
	    
	}     	

    

    public function readAll($from_record_num, $records_per_page)
    {
    	//query to read all fag records
    	$query = "SELECT
	                fag_uid,
	                fag_title,
	                startdato,
	                enddato
	            FROM " . $this->table_name . "
	            ORDER BY startdato DESC
	            LIMIT ?, ?";

		// prepare the query
	    $stmt = $this->conn->prepare($query);

	    // bind the values
	   $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
	   $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

	   // execute query
	    $stmt->execute();

	   // return values
	   return $stmt;

    }

    public function readOne()
    {
    	//query to read all fag records
    	$query = "SELECT
	                fag_uid,
	                fag_title,
	                startdato,
	                enddato
	            FROM " . $this->table_name . "
	            WHERE fag_uid = ?
	            LIMIT 0, 1";

		// prepare the query
	    $stmt = $this->conn->prepare($query);

	    // bind the values
	    $stmt->bindParam(1, $this->fag_uid, PDO::PARAM_INT);
	   
	    // execute query
	    $stmt->execute();

	    // return values
	  	$row = $stmt->fetch(PDO::FETCH_ASSOC);
     	$this->fag_uid = $row['fag_uid'];
        $this->fag_title = $row['fag_title'];
        $this->startdato = $row['startdato'];
        $this->enddato = $row['enddato'];
    }

    public function fagOversigt($from_record_num, $records_per_page)
    {
    	//query to read all fag records

    	$query = "SELECT fag_uid, 
    					 fag_title, 
    					 startdato, 
    					 enddato, 
    					 udd_title
				FROM udd_og_fag JOIN fag ON udd_og_fag.fag_id = fag.fag_uid JOIN uddannelse ON udd_og_fag.udd_id = uddannelse.udd_uid ORDER BY fag.fag_uid";

		// prepare the query
	    $stmt = $this->conn->prepare($query);

	    // bind the values
	   $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
	   $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

	   // execute query
	    $stmt->execute();

	   // return values
	   return $stmt;
    }

    //method to update information about chosen record
    public function update()
    {
    	$query = "UPDATE
                    " . $this->table_name . "
                SET
                    fag_uid = :fag_uid,
	                fag_title = :fag_title,
	                startdato = :startdato,
	                enddato = :enddato
                WHERE
                    fag_uid = :fag_uid";
     
        $stmt = $this->conn->prepare($query);
     
        // posted values
        $this->fag_uid= htmlspecialchars(strip_tags($this->fag_uid));
	    $this->fag_title=htmlspecialchars(strip_tags($this->fag_title));
	    $this->startdato= htmlspecialchars(strip_tags($this->startdato));
	    $this->enddato = htmlspecialchars(strip_tags($this->enddato));
     
        // bind parameters
        // bind the values
	    $stmt->bindParam(':fag_uid', $this->fag_uid);
	    $stmt->bindParam(':fag_title', $this->fag_title);
	    $stmt->bindParam(':startdato', $this->startdato);
	    $stmt->bindParam(':enddato', $this->enddato);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    // used for paging users
	public function countAll(){

	    // query to select all user records
	    $query = "SELECT fag_uid FROM " . $this->table_name . "";

	    // prepare query statement
	    $stmt = $this->conn->prepare($query);

	    // execute query
	    $stmt->execute();

	    // get number of rows
	    $num = $stmt->rowCount();

	    // return row count
	    return $num;
	}

	//method to delete chosen record from database
    function delete(){
     
        $query = "DELETE FROM " . $this->table_name . " WHERE fag_uid = ?";
         
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->fag_uid);
     
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>
