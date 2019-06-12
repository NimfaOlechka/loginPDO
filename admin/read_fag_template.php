<?php
    // TODO: search form
    echo "<form role='search' action='search.php'>";
        echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
            $search_value=isset($search_term) ? "value='{$search_term}'" : "";
            echo "<input type='text' class='form-control' placeholder='Skriv fag nummer eller title...' name='s' id='srch-term' required {$search_value} />";
            echo "<div class='input-group-btn'>";
                echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
            echo "</div>";
        echo "</div>";
    echo "</form>";

    // display the table if the number of users retrieved was greater than zero
    if($num>0){
     
        echo "<table class='table table-hover table-responsive table-bordered'>";
     
        // table headers
        echo "<tr>";
            echo "<th>Fag nr.</th>";
            echo "<th>Titel</th>";
            echo "<th>Start dato</th>";
            echo "<th>End dato</th>";
            echo "<th>Uddannelse</th>";             
            echo "<th>Action</th>";           
        echo "</tr>";
     
        // loop through the user records
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
                $relation->fag_id = $fag_uid;
                $stmt2 = $relation->read_udd();
                echo "<td>";
                echo "<ul>";
                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        extract($row2);
                        $udd->udd_uid = $udd_id;
                        $udd->readName();
                        echo "<li>";
                        echo $udd->udd_title;
                        echo "</li>";
                    }             
               echo "</ul>";
                echo "</td>";
                  
                echo "<td>"; 

                    // edit record button
                    echo "<a href='update_fag.php?id={$fag_uid}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete record button
                    echo "<a delete-id='{$fag_uid}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
                echo "</td>";
                              
            echo "</tr>";
            }
     
        echo "</table>";
     
        $page_url="read_fag.php?";
        $total_rows = $fag->countAll();
     
        // actual paging buttons
        include_once 'paging.php';
    }
     
    // tell the user there are no selfies
    else{
        echo "<div class='alert alert-danger'>
            <strong>No fag found.</strong>
        </div>";
    }
?>