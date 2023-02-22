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
	<form action="" method="POST">
		 <label>Question 2 <span style="color: red; font-weight: bold; zoom:1.3;">*</span></label> <br><br>
              <select name="lga" class="form-control">
            <option value="">Select LGA</option>
            <?php
                $query = mysqli_query($con, "SELECT * FROM `lga` ORDER BY `uniqueid` ASC");
                while ($rows = mysqli_fetch_array($query)) {
                  $lga_id = $rows['uniqueid'];
                  $lga = $rows['lga_name'];
                 ?>
                 
                  <option value="<?php echo $lga_id; ?>"><?php echo $lga; ?></option>
           <?php }
                 
              ?>
          </select> <br> <br>

           <button type="submit" name="add"><strong> Submit</strong> </button>
		</form>
			<?php
              if (isset($_POST['add'])) {

              	?>

              	<table border="1">
					 <tr>
					 	<th>S/N</th>
					    <th>Party Abbreviation</th>
					    <th>Score</th>
					  </tr>

				<?php
                $lga = mysqli_escape_string($con, $_POST['lga']);

                if (empty($lga)) {
                  echo    "Kindly Select A Local Government";
                } else {
            
            		$sno = 1;
                     $query = mysqli_query($con, "SELECT `party_abbreviation`, `lga_id`, SUM(`party_score`) AS score FROM `announced_pu_results` JOIN `polling_unit` ON `announced_pu_results`.`polling_unit_uniqueid`=`polling_unit`.`uniqueid` GROUP BY `party_abbreviation` HAVING `polling_unit`.`lga_id` = '$lga'");

                     while($row = mysqli_fetch_array($query)){
                     	$result = $row['score'];
                     	$party = $row['party_abbreviation'];
                     	?>
						  <tr>
						  	<td> <?php echo $sno;  ?></td>
						    <td><?php echo $party;  ?></td>
						    <td><?php echo $result;  ?></td>
						 </tr>

				<?php
					$sno ++;
                     } ?>
                     </table>
              <?php
                }
              }
            ?>
			          <br><br><br>
                <a href="index.php"> <button type="" name="go-back"><strong> Go Back</strong>  </button></a>

	</body>
</html>
