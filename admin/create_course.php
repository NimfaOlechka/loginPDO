<?php
// core configuration
include_once "../config/core.php";
// set page title
$page_title = "Opret ny kursus"; 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../objects/kursus.php';

include_once '../objects/fag.php';
include_once '../objects/tilmelde.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$kursus = new Kursus($db);

$tilmelde = new tilmelde($db);
  
// include page header HTML
include_once "layout_head.php";

// registration form HTML
// code when form was submitted
// if form was posted
if ($_POST) {
	
	// get database connection
	$database = new Database();
	$db = $database->getConnection();
 
	// initialize objects
	$kursus = new Kursus($db);	
	
	// create fag will be here
	// set values to object properties
	$kursus->fag_uid = $_POST['fag_uid'];
	$kursus->startdato = $_POST['startdato'];	
	$kursus->pladser = $_POST['pladser'];
		
	
	//create ny record in database
		if ($kursus->create()) {
			
			// ?? TODO: call function to show updated list of data - list of courses
			echo "<div class='alert alert-info'>";
			echo "Successfully registered.";
			echo "</div>";
					
		} else {
			//alert user about fail
			echo "<div class='alert alert-danger' role='alert'>Unable to add ur record. Please try again.</div>";

		}
	
}


//button to create new record
echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#opret_fag">
    Opret ny kursus
  </button>';

?>
<div class="modal" id="opret_fag">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Opret ny kursus</h2>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        	</div>
        	<!--Input form for for to create a new course-->
	        <div class="modal-body">
	            <form method='post'>			 
					<table class='table table-responsive'>
					<!-- choose fag select option field -->
					<tr>
					    <td>Valgfri fag</td>
					    <td>
					    <?php	
						    //include read all existed records from db
							include_once "dropdown_fag_template.php";
						?>
					    </td>
					</tr> 

					<tr>
					    <td>Varighed</td>
					    <td><select name="varighed"  id="varighed" required class="form-control">
					    	<option value hidden>Varighed</option>
					    	<option value="1 Uge"> 1 Uge </option>
					    	<option value="1,5 Uge"> 1,5 Uge </option>
					    	<option value="2 Uge"> 2 Uge </option>
					    	<option value="2,5 Uge"> 2,5 Uge </option>
					    </select></td>
					</tr>		        
						 
					<tr>
					    <td>Start dato</td>
					    <td><input type='date' id="datepicker1" name='startdato' class='form-control' value="" required/></td>
					</tr>
						 
					<tr>
					    <td>Slut dato</td>
					    <td><input type="date" id="datepicker2" name="enddato" class='form-control' required /></td>
					</tr>       
						 
					<tr>
					    <td>Antal pladser</td>
					    <td><input type="text" name="pladser" class='form-control'  /></td>
					</tr>	
						 
					<tr>
					    <td></td>
						<td>
						    <button type="submit" class="btn btn-success" id="submit" name="submit">
						        <span class="glyphicon glyphicon-plus"></span> Opret
						    </button>
						</td>
					</tr>						 
					</table>
				</form>
	        </div>
        </div>
    </div>	
</div>		
<?php
 


echo "<div class='col-md-12'>";

// include products table HTML template
//include_once "read_fag_template.php";
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>
<script>
	$(document).ready(function(){

		//var d = Date().now();
		//d = d.toString();
		// Printing the current date 
 // document.write("The current date is: " + d);
		//$("#datepicker1").val(d);
	});
	
	
</script>