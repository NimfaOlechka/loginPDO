<?php
// core configuration
include_once "../config/core.php";
// set page title
$page_title = "Opret ny fag"; 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../objects/fag.php';
include_once '../objects/fill_select_box.php';
  
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
	$fag = new Fag($db);
	
	 // set fag uid to detect if it already exists
	$fag->fag_uid = $_POST['fag_uid'];
	    

	//check if fag already exists
	if ($fag->fagExist()) {
		//alert user about it
		echo "<div class='alert alert-danger'>";
	            echo "The fag you trying to create is already registered.";
	    echo "</div>";
	}
	else {
	// create fag will be here
	// set values to object properties
	$fag->fag_title = $_POST['fag_title'];
	$fag->startdato = $_POST['startdato'];
	$fag->enddato = $_POST['enddato'];
	$fag->pladser = $_POST['pladser'];
	$fag->udd_uid = $_POST['udd_uid'];	
	
	//create ny record in database
		if ($fag->create()) {
			//loop gennem values af select box and add relation between tables
			$fag->setUddannelse();
			echo "<div class='alert alert-info'>";
			echo "Successfully registered.";
			echo "</div>";
					
		} else {
			//alert user about fail
			echo "<div class='alert alert-danger' role='alert'>Unable to add ur record. Please try again.</div>";

		}
	}
}

 
echo "<div class='col-md-12'>";

?>
		<form method='post' id='opret_fag'>
		 
		    <table class='table table-responsive'>
		 
		        <tr>
		            <td class='width-30-percent'>Fag nr.</td>
		            <td><input type='text' name='fag_uid' class='form-control' required value="<?php echo isset($_POST['fag_uid']) ? htmlspecialchars($_POST['fag_uid'], ENT_QUOTES) : "";  ?>" /></td>
		        </tr>
		 
		        <tr>
		            <td>Fag title</td>
		            <td><input type='text' name='fag_title' class='form-control' required value="<?php echo isset($_POST['fag_title']) ? htmlspecialchars($_POST['fag_title'], ENT_QUOTES) : "";  ?>" /></td>
		        </tr>
		 
		        <tr>
		            <td>Start dato</td>
		            <td><input type='date' name='startdato' class='form-control' required/></td>
		        </tr>
		 
		        <tr>
		            <td>Slut dato</td>
		            <td><input type="date" name="enddato" class='form-control' required /></td>
		        </tr>		        
		 
				<tr>
		            <td>Antal pladser</td>
		            <td><input type="text" name="pladser" class='form-control' required /></td>
		        </tr>	
		        <!-- uddannelse 'select' field -->
		        <tr >
		            <td >Uddannelse</td>
		            <td id="add_udd"></td>

		        </tr>   

		        <tr>
		            <td></td>
		            <td>
		                <button type="button" class="btn btn-primary add" name="add">
		                    <span class="glyphicon glyphicon-plus"></span>Tilføj uddannelse
		                </button>
		            </td>
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
	<?php
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>
<script>
	$(document).ready(function(){
		$(document).on('click', '.add', function(){
			var html = '';
			html += '<tr>';			
			html += '<td><select name="udd_uid[]" class="form-control" required><option value="">Select Unit</option><?php echo fill_select_box(); ?></select></td>';
			html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

			$('#add_udd').append(html);
		});

		$(document).on('click', '.remove', function(){
			$(this).closest('tr').remove();
		});
		
	});

	
</script>
