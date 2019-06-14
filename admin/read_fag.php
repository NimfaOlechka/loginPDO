<?php
//core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../objects/fag.php';
include_once '../objects/udd_og_fag.php';
include_once '../objects/udd.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$fag = new Fag($db);
$relation = new Relation($db);
$udd = new Uddannelse($db);
 
// set page title
$page_title = "Uddannelsesspecifikke fag";
// to identify page for paging
$page_url="read_fag.php?";
// read all fag records from the database
$stmt = $fag->readAll($from_record_num, $records_per_page); 
// include page header HTML
include_once "layout_head.php";

 
echo "<div class='col-md-12'>";
//button to create new record
echo '<a href="create_fag.php" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span>Opret ny fag</a>';

// include products table HTML template
include_once "read_fag_template.php";
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>