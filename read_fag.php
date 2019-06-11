<?php
// required headers
//header("Content-Type: text/html; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
/// core configuration
include_once "config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once 'config/database.php';
include_once 'objects/fag.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$fag = new Fag($db);
$udd_uid = $_SESSION['udd_uid']; 
// set page title
$page_title = "Uddannelsesspecifikke fag";
 
// include page header HTML
include_once "layot_head.php";

 
echo "<div class='col-md-12'>";

//button to create new record
//echo '';

    // read all fag records from the database
    $stmt = $fag->readSelected($udd_uid);
	 
    // count retrieved records
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="read_fag.php?";
 
    // include products table HTML template
    include_once "read_fag_template.php";
//echo '</form>';
 
echo "</div>";
 
// include page footer HTML
include_once "layot_foot.php";
?>