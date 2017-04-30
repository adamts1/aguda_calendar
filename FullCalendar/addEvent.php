<?php

// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['color']) && isset($_POST['locationId']) && isset($_POST['teacherId'])&& isset($_POST['locationId']) && isset($_POST['courseId'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$centerId = $_POST['centerId'];
	$locationId = $_POST['locationId'];
	$centerid = $_POST['centerId'];
	$teacherid = $_POST['teacherId'];
	$courseid = $_POST['courseId'];
	$students = $_POST['students_known']; // studentId array from Select2 
    $endNumber1 = strtotime("$end");
	$startNumber1 = strtotime("$start");
	$start = date("Y-m-d H:i:s",$startNumber1); 
	$end = date("Y-m-d H:i:s",$endNumber1);
	$quantity = $_POST['quantity'];


    for ($i1=0; $i1<$quantity; $i1++)
	{

	$sql = "INSERT INTO events(title, start, end, color, locationid ,centerid ,teacherid, courseid ) values ('$title', '$start', '$end', '$color', '$locationId', '$centerid', '$teacherid', '$courseid')";
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

	// Fetch the last activityId inserted
	$select = "SELECT MAX(id) FROM events";
	$selects = $bdd->prepare($select); 
	$selects->execute();
	$names = $selects->fetch(); // names is 2 arrays and we need to execute them
	$eventsNumberInt =  $names[0]; // This is the first execute

	for( $i =0; $i < count( $students ); $i++ )
	{    
		$c[$i] = (int) $students[$i];
	}

		// Insertion to studentactivity table
	for($test = 0; $test < count($c); $test++)
	{
	$studentName=$c[$test];
	$insertToStudentactivity = "INSERT INTO `student_events`(`studentid`, `eventsid`) VALUES ('$studentName','$eventsNumberInt')"; // Insert to studentactivity table
	
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

        $startNumber1 = $startNumber1+60*60*24*7;
		$start = date("Y-m-d H:i:s",$startNumber1); 
		$endNumber1 = $endNumber1+60*60*24*7;
		$end = date("Y-m-d H:i:s",$endNumber1); 
	}
}


header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>