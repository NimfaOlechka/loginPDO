<?php
//core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../objects/fag.php';
include_once '../objects/udd_og_fag.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$fag = new Fag($db);
$relation = new Relation($db); 
// set page title
$page_title = "Uddannelsesspecifikke fag";
 
// include page header HTML
include_once "layout_head.php";

 
echo "<div class='col-md-12'>";

//button to create new record
echo '<a href="create_fag.php" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span>Opret ny fag</a>';

    // read all fag records from the database
    $stmt = $fag->fagOversigt($from_record_num, $records_per_page);
	 
    // count retrieved records
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="read_fag.php?";
 
    // include products table HTML template
    include_once "read_fag_template.php";
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>