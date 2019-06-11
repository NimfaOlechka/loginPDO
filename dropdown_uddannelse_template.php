<?php

// include classes
include_once 'config/database.php';
include_once 'objects/udd.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$udd = new Uddannelse($db);
// read all from the table
$stmt = $udd->read();
// count retrieved records
$num = $stmt->rowCount();

    // display the table if the number of users retrieved was greater than zero
    if($num>0){

        echo "<select name='udd_uid' class='form-control'>";

        // loop through the user records
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            // display user details
            echo "<option value = '{$udd_uid}'>{$udd_title}</option>";
            }

        echo "</select>";
      

    }

    // tell the user there are no selfies
    else{
        echo "<select class='udd_uid' class='form-control'>
            <option>No options</option>
        </select>";
    }
?>
