<?php

// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['color']) && isset($_POST['location'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$location = $_POST['location'];
	$centerid = $_POST['centerid'];
	$students = $_POST['students_known']; // studentId array from Select2 



	$sql = "INSERT INTO events(title, start, end, color, location ,centerid) values ('$title', '$start', '$end', '$color', '$location', '$centerid')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

	for( $i =0; $i < count( $students ); $i++ )
	{    
		$c[$i] = (int) $students[$i];
	}

		// Insertion to studentactivity table
	for($test = 0; $test < count($d); $test++)
	{
	$studentName=$c[$test];
	$insertToStudentactivity = "INSERT INTO `group_student`(`id`, `groupid`) VALUES ('$studentName','$centerid')"; // Insert to studentactivity table
	
	$insertToStudentactivitys = $bdd->prepare( $insertToStudentactivity ); // We must this line to insert values into table!!!!!
	if ($insertToStudentactivitys == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare studentactivity table');
		}

	$insertToStudentactivityTable = $insertToStudentactivitys->execute(); // We must this line to insert values into table!!!!!
	if ($insertToStudentactivityTable == false) {
			print_r($insertToStudentactivityTable->errorInfo());
			die ('Erreur execute studentactivity table');
		}
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
