<html>
<?php


include "connectdb.php";
include "index.php";

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
	   
		$result = mysql_query("SELECT L.name, L.id FROM location AS L
							   JOIN center AS C  ON L.centerid =C.id 
                               JOIN supervisor AS S ON C.id =S.centerId
                               WHERE  S.id = '$identity'"); ?>

	<option value="0">בחר</option>
	<?php
		while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row['id'] ."'>" . $row['name'] ."</option>";
			}
	}

	elseif($optionChoosen == '3') { // If activity type selected
	   
		$result = mysql_query("SELECT U.username, U.id FROM user AS U
							   JOIN teacher AS T  ON U.id =T.id 
							   JOIN center AS C  ON T.centerid =C.id 
                               JOIN supervisor AS S ON C.id =S.centerId
                               WHERE  S.id = '$identity'"); ?>

	<option value="0">בחר</option>
	<?php
		while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row['id'] ."'>" . $row['username'] ."</option>";
			}
	}

	elseif($optionChoosen == '4') { // If activity type selected
	   
		$result = mysql_query("SELECT C.coursename, C.id FROM course AS C
							   JOIN course_center AS CC  ON C.id =CC.courseid 
							   JOIN center AS C1  ON CC.centerid  =C1.id 
                               JOIN supervisor AS S ON C1.id =S.centerId
                               WHERE  S.id = '$identity'"); ?>

	<option value="0">בחר</option>
	<?php
		while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row['id'] ."'>" . $row['coursename'] ."</option>";
			}
	}
	elseif($optionChoosen == '5') { // If activity type selected
	   
		$result = mysql_query("SELECT S.nickname, S.id FROM student AS S
							   JOIN center AS C  ON S.centerid =C.id 
                               JOIN supervisor AS S1 ON C.id =S1.centerId
                               WHERE  S1.id = '$identity'"); ?>

	<option value="0">בחר</option>
	<?php
		while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row['id'] ."'>" . $row['nickname'] ."</option>";
			}
	}
	
	?>


</html>
