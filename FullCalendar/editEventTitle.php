<?php

require_once('bdd.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	
}
//////////////////////multy delete///////////
if (isset($_POST['deleteAll']) && isset($_POST['id'])){

 	$id = $_POST['id'];
	$start1 = $_POST['start'];
	$startNumber1 = strtotime("$start1");
	$startNumber1 = $startNumber1-'9000';
	$start2 = date("Y-m-d H:i:s",$startNumber1); 
	$courseId = $_POST['courseId'];
    $locationId = $_POST['locationId'];	
    $groupNumber = $_POST['groupNumber'];	

	 
	
	$sql = "DELETE FROM events WHERE locationid = $locationId AND groupNumber = $groupNumber AND courseId = $courseId AND start > '$start2'";
//var_dump($sql);

	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
////////////////////////////////!multy delete///////////

elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id']) && isset($_POST['locationId']) && isset($_POST['teacherId']) && isset($_POST['courseId'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$locationId = $_POST['locationId'];
	$centerid = $_POST['centerId'];
	$teacherid = $_POST['teacherId'];
	$courseid = $_POST['courseId'];
	$students = $_POST['students_known']; 

	
	$sql = "UPDATE events SET  title = '$title', color = '$color', locationId = '$locationId', centerid = '$centerid', teacherid = '$teacherid', courseid = '$courseid'  WHERE id = $id ";

	
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

		// Update students -> delete all students in activity and then insert new students
	$deleteStudents = "DELETE FROM student_events WHERE eventsid = $id";
	
	$query3 = $bdd->prepare( $deleteStudents );
	if ($query3 == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare delete from studentactivity');
	}
	
	$sth3 = $query3->execute();
	if ($sth3 == false) {
	 print_r($query3->errorInfo());
	 die ('Erreur execute from studentactivity');
	}

			// Convert students into int array
	for( $i =0; $i < count( $students ); $i++ )
	{    
		$d[$i] = (int) $students[$i];
	}

		// Insertion to studentactivity table
	for($test = 0; $test < count($d); $test++)
	{
	$studentName=$d[$test];
	$insertToStudentactivity = "INSERT INTO `student_events`(`studentid`, `eventsid`) VALUES ('$studentName','$id')"; // Insert to studentactivity table
	
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
header('Location: index.php');

	
?>
