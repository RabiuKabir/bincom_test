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
       <table border="1">
			 <tr>
			 	  <th>S/N</th>
			 	  <th>Polling Unit Name</th>
			 	  <th>Polling Unit No.</th>
			    <th>Party</th>
			    <th>Score</th>
			  </tr>

			<?php
        
        	$sno = 1;
                 $query = mysqli_query($con, "SELECT `party_abbreviation`, `polling_unit_name`, `polling_unit_number`, `party_score` FROM `announced_pu_results` JOIN `polling_unit` ON `announced_pu_results`.`polling_unit_uniqueid`=`polling_unit`.`uniqueid` ORDER BY `polling_unit_number` ASC");
                 while($row = mysqli_fetch_array($query)){
                 	$result = $row['party_score'];
                 	$party = $row['party_abbreviation'];
                 	$pu_number = $row['polling_unit_number'];
                 	$pu_name = $row['polling_unit_name'];
                 	?>
					  <tr>
					  	<td><?php echo $sno;  ?></td>
					    <td><?php echo $pu_name;  ?></td>
					    <td><?php echo $pu_number;  ?></td>
					    <td><?php echo $party;  ?></td>
					    <td><?php echo $result;  ?></td>
					 </tr>

				<?php
					$sno ++;
         } ?>
 		</table>
		      	 <br><br><br>
                <a href="index.php"> <button type="" name="go-back"><strong> Go Back</strong>  </button></a>
	</body>
</html>
