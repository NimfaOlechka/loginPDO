<?php
    // display the table if the number of users retrieved was greater than zero
    if($num >= 0){
     
        echo "<table class='table table-hover table-responsive table-bordered'>";
     
        // table headers
        echo "<tr>";
            echo "<th>Fag nr.</th>";
            echo "<th>Titel</th>";
            echo "<th>Start dato</th>";
            echo "<th>End dato</th>";
            //echo "<th>Uddannelse</th>"; // TODO: DELETE THIS COLUMN HEAD
            echo "<th>Action</th>";                      
        echo "</tr>";
     
        // loop through the course records 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            //print row object  - delete at the end
            // print_r($row);
            
            // display user details
            echo "<tr>";
                echo "<td>{$fag_uid}</td>";
                echo "<td>{$fag_title}</td>";
                echo "<td>{$startdato}</td>";
                echo "<td>{$enddato}</td>";
              //  echo "<td>{$udd_title}</td>";     //TODO: DELETE THIS COLUMN   
                echo "<td>"; 
                    // apply for course button
                    echo "<form action='tilmelde_checker.php' method='post' id='tilmelde'>";
                    echo "<input type='text' tilmelde-id='{$email}' name='{$email}' hidden>";
                    echo "<input type='text' tilmelde-id='{$fag_uid}' name='{$fag_uid}' hidden>";
                    echo "<button class='btn btn-success' name='submit' value='Tilmeld'>";
                    //echo "<a tilmeld-id='{$fag_uid}' class='btn btn-success tilmeld-object'>";
                        echo "<span class='glyphicon glyphicon-plus'></span> Tilmeld";
                       // echo "</a>";
                    echo "</button>";
                    echo "</form>";
                echo "</td>";          
            echo "</tr>";
            }
     
        echo "</table>";     
        $page_url="read_fag.php?";     
       
    }
     
    // tell the user there are no courses
    else{
        echo "<div class='alert alert-danger'>
            <strong>There is no courses found that you can apply. Please contact our administration office.</strong>
        </div>";
    }
?>