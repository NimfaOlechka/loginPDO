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
include_once 'objects/tilmelde.php';

 
if(isset($_POST['submit'])){

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$tilmelde = new tilmelde($db);
//$users_id = $_SESSION['users_id'];
//$fag = $_SESSION['fag_uid'];  
// set page title
//$page_title = "Uddannelsesspecifikke fag";


    $tilmelde->users_id=$_POST['users_id'];
    $tilmelde->fag_uid=$_POST['fag_uid'];

if($tilmelde->checker($users_id, $fag_uid)){
echo "";


}else($tilmelde->create()){
echo 'Succecsfull';
}


}

?>