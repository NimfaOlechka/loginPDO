<?php
// required headers
//header("Content-Type: text/html; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
/// core configuration
include_once "config/core.php";
  
// include classes
include_once 'config/database.php';
include_once 'objects/tilmelde.php';


if(isset($_POST)){

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$tilmelde = new tilmelde($db);

    $tilmelde->users_id=$_POST['users_id'];
    $tilmelde->fag_uid=$_POST['fag_uid'];
  
if($tilmelde->checker()){
header("Location: {$home_url}/read_fag.php?Failed");

}else{

if($tilmelde->create()){
    header("Location: {$home_url}/read_fag.php?Successfully");
}
}
}

?>