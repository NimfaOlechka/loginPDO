<?php
//TODO: change it according to new structure and classes
// core configuration
include_once "../config/core.php";
// set page header
$page_title = "Update Fag";
//include page header HTML
include_once "layout_head.php";
 
// contents will be here
echo "<div class='right-button-margin'>";
    echo "<a href='read_fag.php' class='btn btn-default pull-right'>fag oversigt</a>";
echo "</div>";
// retrieve one product will be here
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and class files
include_once '../config/database.php';
include_once '../objects/fag.php';
include_once '../objects/udd.php';
include_once '../objects/udd_og_fag.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$fag = new Fag($db);
$udd = new Uddannelse($db);
$relation = new Relation($db);
 
// set ID property of fag to be edited
$fag->fag_uid = $id;
$relation->fag_id = $id;

// read the details of fag to be edited
$fag->readOne();
// if the form was submitted
if($_POST){
 
    // set object fag property values
    // set values to object properties
    $fag->fag_uid = $_POST['fag_uid'];
    $fag->fag_title = $_POST['fag_title'];
    $fag->startdato = $_POST['startdato'];
    $fag->enddato = $_POST['enddato'];
    //$fag->udd_uid = $_POST['udd_uid'];  
 
    // update the record
    if($fag->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Record was updated.";
        echo "</div>";
    }
 
    // if unable to update the record, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update product.";
        echo "</div>";
    }
}
?>

<!-- 'update fag' form will be here -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>fag nr.</td>
            <td><input type='text' name='fag_uid' value='<?php echo $fag->fag_uid; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>fag title</td>
            <td><input type='text' name='fag_title' value='<?php echo $fag->fag_title; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Start dato</td>
            <td><input type='date' name='startdato' value='<?php echo $fag->startdato; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>End dato</td>
            <td><input type='date' name='enddato' class='form-control' value='<?php echo $fag->enddato; ?>' /></td>
        </tr>
 
        <tr>
            <td>Uddannelse</td>
            <td>
                <!-- categories select drop-down will be here -->
                <?php
					$stmt = $relation->read_udd();
					 
					// put them in a select drop-down
					echo "<select class='form-control' name='udd_id'>";
					 
					    echo "<option>Please select...</option>";
					    while ($row_udd = $stmt->fetch(PDO::FETCH_ASSOC)){
					        $udd_id=$row_udd['udd_id'];
					        //$category_name = $row_udd['name'];
					   
					        // current category of the product must be selected
					        if($udd->udd_uid==$udd_id){
					            echo "<option value='$udd_id' selected>";
					        }else{
					            echo "<option value='$udd_id'>";
					        }
					 
                            echo "$udd_id</option>";
                            echo '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
					        
                           
					    }
					echo "</select>";
				?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
 
// set page footer
include_once "layout_foot.php";
?>