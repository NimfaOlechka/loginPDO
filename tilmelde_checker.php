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
// set page title
$page_title = "Uddannelsesspecifikke fag";

     //$users_id = ($_POST['users_id']);
	 //$fag_uid =  ($_POST['fag_uid']);
    $tilmelde->users_id=$_POST['users_id'];
    $tilmelde->fag_uid=$_POST['fag_uid'];
    echo "Først del";
if($tilmelde->checker()){
echo "Something wrong ERROR";


}else{

if($tilmelde->create()){

echo "Succecsfull tilmelde";
}
}
}
/*
if($_POST){
 
    try{
     
        // insert query
        $query = "INSERT INTO products SET users_id=:users_id, fag_uid=:fag_uid, created=:created";
 
        // prepare query for execution
       // $stmt = $conn->prepare($query);
 
        // posted values
        $user=htmlspecialchars(strip_tags($_POST['users_id']));
        $fag=htmlspecialchars(strip_tags($_POST['fag_uid']));
 
        // bind the parameters
        $stmt->bindParam(':users_id', $user);
        $stmt->bindParam(':fag_uid', $fag);
         
        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}*/

?>