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
//$users_id = $_SESSION['users_id'];
//$fag = $_SESSION['fag_uid'];  

     //$users_id = ($_POST['users_id']);
	 //$fag_uid =  ($_POST['fag_uid']);
    $tilmelde->users_id=$_POST['users_id'];
    $tilmelde->fag_uid=$_POST['fag_uid'];
    echo "Først del";
if($tilmelde->checker()){
echo "Something went wrong maybe you allrede signup to it.";
header("Location: {$home_url}/read_fag.php");

}else{

if($tilmelde->create()){

    echo "Successfully Tilmelde."; 
    header("Location: {$home_url}/read_fag.php");
}
}
}

?>