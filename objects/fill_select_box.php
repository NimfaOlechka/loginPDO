<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
//include_once "../login_checker.php";

// include classes
include_once '../config/database.php';
include_once 'udd.php';

function fill_select_box(){

	// get database connection
	$database = new Database();
	$db = $database->getConnection();

	// initialize objects
	$udd = new Uddannelse($db);
	$stmt = $udd->read();

	$output = '';
	$result = $stmt->fetchAll();
	foreach ($result as $row) {
		# loop through all records and create select list
		$output .= '<option value="'.$row['udd_uid'].'">'.$row["udd_title"].'</option>';
	}
	return $output;
}

?>
