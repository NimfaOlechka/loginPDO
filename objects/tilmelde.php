<?php
class tilmelde {
	// database connection and table name
    private $conn;
    private $table_name = "tilmelde";
	private $table_name2 = "users";
	private $table_name3 = "fag";
	//object properties
    //public $id;
    public $users_id;
    public $fag_uid;
    public $created;
    
    public function __construct($db){
        $this->conn = $db;
	}
	
 // check if given Signup exist in the database
 function checker(){
	 
	// query to check if signup exists
	$query = "SELECT users_id,fag_uid, created FROM ". $this->table_name ." WHERE fag_uid = ? AND users_id = ?";
	// prepare the query
	$stmt = $this->conn->prepare( $query );
 
	// sanitize
	$this->fag_uid=htmlspecialchars(strip_tags($this->fag_uid));
	$this->users_id=htmlspecialchars(strip_tags($this->users_id));
	
	// bind given signup value
	$stmt->bindParam(1, $this->fag_uid);
	$stmt->bindParam(2, $this->users_id);

	// execute the query
	$stmt->execute();
 
	// get number of rows
	$num = $stmt->rowCount();
 
	// if signup exists, assign values to object properties for easy access and use for php sessions
	if($num > 0){
		// get record details / values
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
		// assign values to object properties
		$this->users_id = $row['users_id'];
		$this->fag_uid = $row['fag_uid'];

		$this->showError($stmt);
		// return true because signup exists in the database
		return true;
	}
	
	
	// return false if signup does not exist in the database
	return false;
 }

// create new user record
function create(){

	// to get time stamp for 'created' field
	$this->created=date('Y-m-d H:i:s');
 
	// insert query
	$query = "INSERT INTO
				" . $this->table_name . "
			SET
				users_id = :users_id,
				fag_uid = :fag_uid,
				created = :created";
 
	// prepare the query
	$stmt = $this->conn->prepare($query);
 
	// sanitize
	$this->users_id=htmlspecialchars(strip_tags($this->users_id));
	$this->fag_uid=htmlspecialchars(strip_tags($this->fag_uid));

 
	// bind the values
	$stmt->bindParam(':users_id', $this->users_id);
	$stmt->bindParam(':fag_uid', $this->fag_uid);
	$stmt->bindParam(':created', $this->created);
 
	// execute the query, also check if query was successful
	if($stmt->execute()){
		return true;
	}else{
		$this->showError($stmt);
		return false;
	}

}
	  //function to show errors if action over object is not succeed
	  public function showError($stmt){
	    echo "<pre>";
	        print_r($stmt->errorInfo());
	    echo "</pre>";
	}

	public function readSelected($id){
		// select query
		$query = "SELECT
		fag.fag_title,
		 fag.fag_uid,
		  fag.startdato,
		   fag.enddato
			FROM ". $this->table_name . "
		INNER JOIN " . $this->table_name2 . " ON tilmelde.users_id = users.id 
		INNER JOIN " . $this->table_name3 . " ON tilmelde.fag_uid = fag.fag_uid
		WHERE users.id = ?
		ORDER BY Startdato DESC;";

		// prepare the query
		$stmt = $this->conn->prepare($query);

		// bind the values
		$stmt->bindParam(1, $id, PDO::PARAM_INT);

		// execute query
		$stmt->execute();

		// return values
		return $stmt;

		/* is the SQL code to see how it will work

		SELECT uddannelse.udd_title,
		fag.fag_title,
		fag.fag_uid,fag.startdato,fag.enddato
		FROM uddannelse
		INNER JOIN udd_og_fag ON udd_og_fag.udd_id = uddannelse.udd_uid 
		INNER JOIN fag ON udd_og_fag.fag_id = fag.fag_uid
		INNER JOIN users ON uddannelse.udd_uid = users.udd_uid
		WHERE users.udd_uid = 2 AND users.id = 1
        ORDER BY Startdato DESC*/
	}
}

    
    ?>
