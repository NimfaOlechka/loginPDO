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


function checker($fag_uid, $users_id){

        	//query to read all fag records
            $query = "SELECT
             users_id,
            fag_uid,
            created
        FROM " . $this->table_name . "
        INNER JOIN " . $this->table_name3 . "
        ON tilmede.fag_uid = fag.fag_uid 
        WHERE fag_uid = ? and users_id = ?
        or created >= fag.Startdato";

// prepare the query
$stmt = $this->conn->prepare($query);

// bind the values
$stmt->bindParam(1, $fag_uid, PDO::PARAM_INT);
$stmt->bindParam(2, $users_id, PDO::PARAM_INT);
// execute query
$stmt->execute();

if($stmt > 0) {
    echo "Du er tilmelde ellers er det allrede forsindt";
}else{


// return values
return $stmt;
}
}

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


	 	
	 
	    // execute the query, also check if query was successful
	    if($stmt->execute()){
	        return true;
	    }else{
	        $this->showError($stmt);
	        return false;
	    }	 
	}
}
    
    ?>