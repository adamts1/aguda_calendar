<?php

require_once('bdd.php');

	if (isset($_POST['delete']) && isset($_POST['id'])){

		$id = $_POST['id'];
		
		$sql = "DELETE FROM events WHERE id = $id";
		$query = $bdd->prepare( $sql );
		if ($query == false) {
		print_r($bdd->errorInfo());
		die ('Erreur prepare delete events');
		}
		$res = $query->execute();
		if ($res == false) {
		print_r($query->errorInfo());
		die ('Erreur execute delete events');
		}
	}

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
		$query = $bdd->prepare( $sql );
		if ($query == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare delete all from events');
		}
		$res = $query->execute();
		if ($res == false) {
			print_r($query->errorInfo());
			die ('Erreur execute delete all from events');
		}

	}


	// update events
elseif (isset($_POST['title'])  && isset($_POST['id']) && isset($_POST['locationId']) ){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$locationId = $_POST['locationId'];
	$centerid = $_POST['centerId'];
	$teacherid = $_POST['teacherId'];
	$courseid = $_POST['courseId'];
	$students = $_POST['students_known']; 

		
			// Update events table
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
		
				
				// Update students -> delete all students in events and then insert new students
		$deleteStudents = "DELETE FROM student_events WHERE eventsid = $id";
		
		$query2 = $bdd->prepare( $deleteStudents );
		if ($query2 == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare delete from studentactivity');
		}
		$sth2 = $query2->execute();
		if ($sth2== false) {
			print_r($query2->errorInfo());
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
				die ('Erreur prepare student_events table');
			}

			$insertToStudentactivityTable = $insertToStudentactivitys->execute(); // We must this line to insert values into table!!!!!
			if ($insertToStudentactivityTable == false) {
				print_r($insertToStudentactivityTable->errorInfo());
				die ('Erreur execute student_events table');
			}
		}
			/// End of update students
		

	} // End of update one events

	/////////////		update kavua 	/////////////
	if (isset($_POST['updateAll']) && isset($_POST['id'])){
	
		$id = $_POST['id'];
		$courseId = $_POST['courseId'];
		$teacherid = $_POST['teacherId'];
		$title = $_POST['title'];
  	  	$students1 = $_POST['students_known']; 
  	    $locationId = $_POST['locationId'];	
		$color = $_POST['color'];
		$centerid = $_POST['centerId'];
    	$groupNumber = $_POST['groupNumber'];	
    	$start1 = $_POST['start'];
		$startNumber1 = strtotime("$start1");
		$startNumber1 = $startNumber1-'9000';
		$start2 = date("Y-m-d H:i:s",$startNumber1); 
		$students = $_POST['students_known'];
		

			// Update events table
	$sql = "UPDATE events SET    title = '$title', color = '$color', centerid = '$centerid', courseid = '$courseId',  locationid = '$locationId', teacherid = '$teacherid' WHERE groupNumber = $groupNumber AND start > '$start2'";
		
		$query = $bdd->prepare( $sql );
		if ($query == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare fixed update  events table');
		}
		$sth = $query->execute();
		if ($sth == false) {
			print_r($query->errorInfo());
			die ('Erreur execute fixed update  events table');
		}

		//////// Number of activities that will change - we need it for insert to student_events table after delete
		$select = "SELECT COUNT(E.id) FROM events E WHERE E.groupNumber= $groupNumber AND E.start > '$start2'";
		$selects = $bdd->prepare($select); 
		$selects->execute();
		$names = $selects->fetch(); // names is 2 arrays and we need to execute them
		$activityNumberCount =  $names[0]; // This is the first execute
		
			// Update users -> delete all users in events and then insert new users
		$deleteAllStudents = "DELETE FROM `student_events` WHERE student_events.eventsid IN (SELECT eventsid FROM events WHERE groupNumber= $groupNumber AND start > '$start2')";

		$query2 = $bdd->prepare( $deleteAllStudents );
		if ($query2 == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare delete kavua delete from student_events');
		}
		$sth2 = $query2->execute();
		if ($sth2 == false) {
			print_r($query2->errorInfo());
			die ('Erreur execute delete kavua from student_events');
		}

			// Convert users into int array
		for( $i =0; $i < count( $students ); $i++ )
		{    
			$e[$i] = (int) $students[$i];
		}

		for( $j=0; $j<$activityNumberCount; $j++){ // loop for changing activityId and insert to student_events

			// Insertion to student_events table
			for($test = 0; $test < count($e); $test++)
			{
				$userName=$e[$test];
				$insertToStudentEvent = "INSERT INTO student_events(eventsid, studentid) VALUES ('$id','$userName') ";
				
				$insertToStudentEvents = $bdd->prepare( $insertToStudentEvent ); // We must this line to insert values into table!!!!!
				if ($insertToStudentEvents == false) {
					print_r($bdd->errorInfo());
					die ('Erreur prepare insert kavua student_events table');
				}
				
				$insertToStudentEventTable = $insertToStudentEvents->execute(); // We must this line to insert values into table!!!!!
				if ($insertToStudentEventTable == false) {
					print_r($insertToStudentEvents->errorInfo());
					die ('Erreur execute insert kavua student_events table');
				}
			
			}
			$id++; // ++ is for insert to StudentEvent
		}



		
}

header('Location: index.php');
	
?>