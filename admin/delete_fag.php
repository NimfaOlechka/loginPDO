<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/fag.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare product object
    $fag = new Fag($db);
     
    // set product id to be deleted
    $fag->fag_uid = $_POST['object_id'];
     
    // delete the product
    if($fag->delete()){
        echo "Record was deleted.";
    }
     
    // if unable to delete the product
    else{
        echo "Unable to delete record.";
    }
}
?>