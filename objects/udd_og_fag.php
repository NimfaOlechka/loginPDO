<?php
/**
 * Relation
 * Class for relations between Fag and Uddannelse classes
 */
class Relation 
{
	private $conn;
	private $table_name = "udd_og_fag";

	public $udd_id = [];
	public $fag_id = [];

	function __construct($db)
	{
		$this->conn = $db;
	}

	//method to  read all udd id  assigned to chosen fag id
	public function read_udd(){
		$query = "SELECT udd_id FROM " . $this->table_name . " WHERE fag_id = ?";
	 
	    $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->fag_id);
        $stmt->execute();
     
     	// return values
	    return $stmt;
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
         
        //$this->udd_id = $row['udd_id'];
	}

	//method to set relationship between class fag and Uddannelse
	public function setRelation(){
		//echo "<script>alert('".$this->udd_id[0]."')</script>";

    	for ($count=0; $count < count($this->udd_id); $count++) { 
		
			//insert query
	    	$query = "INSERT INTO
		                " . $this->table_name . "
		            SET
		                fag_id = :fag_id,
		                udd_id = :udd_id";
		    // prepare the query
		    $stmt = $this->conn->prepare($query);
		    // execute the query
		    $stmt->execute(
				array(			
				':udd_id' => $this->udd_id[$count],
				':fag_id' => $this->fag_id
				)
			);	        
		}
	}

	// used for paging buttons
	public function countAll(){

	    // query to select all user records
	    $query = "SELECT fag_id FROM " . $this->table_name . " GROUP BY fag_id ";

	    // prepare query statement
	    $stmt = $this->conn->prepare($query);

	    // execute query
	    $stmt->execute();

	    // get number of rows
	    $num = $stmt->rowCount();

	    // return row count
	    return $num;
	}
}

?>