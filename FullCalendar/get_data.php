<html>
<?php


include "connectdb.php";

$optionChoosen = $_POST["fatherFilterValue"]; // Value from filter dropdown fatherFilterValue

	if($optionChoosen == '1'){ // If classroom selected
	$result = mysql_query("SELECT * FROM center"); ?>

	<option value="0">בחר</option>>
	<?php
		while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row['id'] ."'>" . $row['name'] ."</option>";
			}
	} 

	elseif($optionChoosen == '2') { // If activity type selected
		$result = mysql_query("SELECT * FROM location"); ?>

	<option value="0">בחר</option>>
	<?php
		while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row['id'] ."'>" . $row['name'] ."</option>";
			}
	}?>


</html>
