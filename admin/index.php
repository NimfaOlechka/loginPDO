<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
 
// include classes
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../objects/fag.php';
include_once '../objects/tilmelde.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$fag = new Fag($db);
$tilmelde = new tilmelde($db);
$user = new User($db);

// set page title
$page_title="List over tilmeldte elever";
 
// include page header HTML
include 'layout_head.php';
 
// read all fag records from the database
$stmt = $tilmelde->read(); 
// count retrieved records
$num = $stmt->rowCount();
echo "<div class='col-md-12'>";

if ($num>0){

    echo "<table class='table table-hover table-responsive table-bordered'>";

    // table headers
        echo "<tr>";
            echo "<th>Fag nr.</th>";
            echo "<th>Titel</th>";
            echo "<th>Elever</th>";             
            echo "<th>Email</th>";  
            echo "<th>Kontakt</th>";               
            echo "<th>Action</th>";           
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<tr>";
                echo "<td>{$fag_uid}</td>";
                $fag->fag_uid = $fag_uid;
                $fag->readOne();
                $user->id = $users_id;
                $user->readOne();
                echo "<td>{$fag->fag_title}</td>";
                echo "<td>{$user->firstname} {$user->lastname}</td>";
                echo "<td>{$user->email}</td>";                
                echo "<td>{$user->contact_number}</td>";
                  
                echo "<td>"; 

                    // edit record button
                    echo "<a href='somepage.php?id={$fag_uid}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Action1";
                    echo "</a>";
   
                echo "</td>";
                              
            echo "</tr>";
            
            # code...
        }


    echo "</table>";

 }
 else {
    echo "<div class='alert alert-danger'>
            <strong>Ingen tilmeldte elever er fundet.</strong>
        </div>";
 }
 
echo "</div>";
 
// include page footer HTML
include_once 'layout_foot.php';
?>