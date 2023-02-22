<?php
include "db_connection.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bincom Test</title>

</head>
<body>
			<?php
	           if (isset($_POST['add'])) {
	              $polling_unit = mysqli_escape_string($con, $_POST['polling_unit']);
	              $party = mysqli_escape_string($con, $_POST['party']);
	              $score = mysqli_escape_string($con, $_POST['score']);

	              if (empty($polling_unit) || empty($party) || empty($score)) {
	                echo    "<strong>All Fields are Required! </strong>";
	              } else {
	          						
	                      $date_created = date("Y-m-d H-i-s");
	                      $user = "Rabiu Kabir";
	                      $ip_address = $_SERVER['REMOTE_ADDR'];  
	                      $query = "INSERT INTO `announced_pu_results` (`polling_unit_uniqueid`, `party_abbreviation`, `party_score`, `entered_by_user`, `date_entered`, `user_ip_address`) VALUES ('$polling_unit', '$party', '$score', '$user','$date_created', '$ip_address')";
	                      if (mysqli_query($con, $query)) {
	                        echo    "<strong> Record was Added Successfully! </strong>";
	                      } else {
	                        echo    " <strong>Failed<br>Please, Try Again!</strong>";
	                      }   
	              }
	            }
	          ?>

		<form action="" method="POST">
			 <label>Question 3 <span style="color: red; font-weight: bold; zoom:1.3;">*</span></label> <br><br>

	 			<label>New Polling Unit:</label> <br>
			  <select name="polling_unit" required>
			            <option value="">Select Polling Unit</option>
			            <?php
			                $query = mysqli_query($con, "SELECT * FROM `polling_unit` WHERE `polling_unit_name`!='' ORDER BY `uniqueid` ASC");
			                while ($rows = mysqli_fetch_array($query)) {
			                  $pu_id = $rows['uniqueid'];
			                  $pu_name = $rows['polling_unit_name'];
			                  $pu_number = $rows['polling_unit_number'];
			                 ?>
			                 
			                  <option value="<?php echo $pu_id; ?>"><?php echo $pu_name.'  ('.$pu_number.')'; ?></option>
			           <?php }
			                 
			              ?>
			          </select> <br> <br>

        <label>Party:</label> <br>
        <select name="party" required>
          <option value="">Select Party</option>
          <?php
              $query = mysqli_query($con, "SELECT * FROM `party` ORDER BY `partyid` ASC");
              while ($rows = mysqli_fetch_array($query)) {
                $party_id = $rows['partyid'];
                $party = $rows['partyname'];
               ?>
               
                <option value="<?php echo $party_id; ?>"><?php echo $party; ?></option>
         <?php }
               
            ?>
        </select> <br> <br>


				<label>Party Score:</label> <br>
   	 		<input type="number" name="score" placeholder="" required> <br><br>

         <button type="submit" name="add"><strong> Submit</strong> </button>
		</form>
					<br><br><br>
          <a href="index.php"> <button type="" name="go-back"><strong> Go Back</strong>  </button></a>
	</body>
</html>
