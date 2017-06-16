<?php

require_once('bdd.php');



if (isset($_POST['title'])  && isset($_POST['id']) && isset($_POST['locationId']) && !isset($_SESSION['courseId']) ){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$locationId = $_POST['locationId'];
	$centerid = $_POST['centerId'];
	$teacherid = $_POST['teacherId'];
	$courseid = $_POST['courseId'];
	$students = $_POST['students_known']; 
	$studentString = $_POST['studentString'];

		
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
			$insertToStudentEvent = "INSERT INTO `student_events`(`studentid`, `eventsid`) VALUES ('$studentName','$id')"; // Insert to studentstudent_events table
			
			$insertToStudentEvents = $bdd->prepare( $insertToStudentEvent ); // We must this line to insert values into table!!!!!
			if ($insertToStudentEvents == false) {
				print_r($bdd->errorInfo());
				die ('Erreur prepare student_events table');
			}

			$insertToStudentEventsTable = $insertToStudentEvents->execute(); // We must this line to insert values into table!!!!!
			if ($insertToStudentEventsTable == false) {
				print_r($insertToStudentEventsTable->errorInfo());
				die ('Erreur execute student_events table');
			}

			/////// we want query for convert studen id to student name
			$converIdToName="SELECT `nickname` FROM `student` WHERE `id`= '$studentName'";
			$converIdToName1 = $bdd->prepare($converIdToName); 
			$converIdToName1->execute();
			$converIdToName2 = $converIdToName1->fetch(); // names is 2 arrays and we need to execute them
			$converIdToName2 =  $converIdToName2[0];
			$studentsNamesArray[$test] = $converIdToName2;

		}

		/// convert users names array to string and insert to activity table as a string
		$studentString = implode(",", $studentsNamesArray); 

		$sql = "UPDATE `events` SET `studentstring`= '$studentString' WHERE `id`= '$id' ";
		
		$query = $bdd->prepare( $sql );
		if ($query == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare update usersString to activity table');
		}
		$sth = $query->execute();
		if ($sth == false) {
			print_r($query->errorInfo());
			die ('Erreur execute update usersString to activity table');

		
		}	/// End of update students
		
		
	} // End of update one events




if (isset($_POST['delete']) && isset($_POST['id'])){

		$id = $_POST['id'];
		$deleteVal = $_POST['delete'];

		
		
		if ($deleteVal == '1'){ // delete

		
		
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


		if ($deleteVal == '2'){ //delete all
		
		$id = $_POST['id'];
		$start1 = $_POST['start'];
		$startNumber1 = strtotime("$start1");
		$startNumber1 = $startNumber1-'9000';
		$start2 = date("Y-m-d H:i:s",$startNumber1); 
		$courseId = $_POST['courseId'];
    	$locationId = $_POST['locationId'];	
	    $groupNumber = $_POST['groupNumber'];	
		$studentString = $_POST['studentString'];

		
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

	/////////////		update kavua 	/////////////
	if ($deleteVal == '3'){ 
	
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
		$studentString = $_POST['studentString'];
		

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
		$eventsNumberCount =  $names[0]; // This is the first execute
		
			// Update users -> delete all users in events and then insert new users
		$deleteAllStudents = "DELETE FROM `student_events` WHERE student_events.eventsid IN (SELECT id FROM events WHERE groupNumber= '$groupNumber' AND start > '$start2')";

		$query7 = $bdd->prepare( $deleteAllStudents );
		if ($query7 == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare delete kavua delete from student_events');
		}
		$sth7 = $query7->execute();
		if ($sth7 == false) {
			print_r($query7->errorInfo());
			die ('Erreur execute delete kavua from student_events');
		}

		// var_dump($query7);
		// die();

			// Convert students into int array
		for( $i =0; $i < count( $students ); $i++ )
		{    
			$e[$i] = (int) $students[$i];
		}

		for( $j=0; $j<$eventsNumberCount; $j++){
			
			$eventsExistOrNotFlag = true;	// Boolean flag for stay or leave this while loop
			while($eventsExistOrNotFlag){
				$resultExistId = "SELECT id FROM events WHERE id='$id'";// We want to check if this eventsId exist or the user delete it
				$selectsResultExistId = $bdd->prepare($resultExistId); 
				$selectsResultExistId->execute();
				$eventsExistOr = $selectsResultExistId->fetch(); // names is 2 arrays and we need to execute them
				$eventsExistOrNot =  $eventsExistOr[0];

				if(empty($eventsExistOrNot)){
					$id++; // If this events dosn't exist -> up the eventsId 1 more
				}
				else{
					$eventsExistOrNotFlag = false; // If this events exist -> exit from this loop
				}
			} // End of while loop


			for($test = 0; $test < count($e); $test++)
			{
				$studentName=$e[$test];
				$insertToStudentEvent = "INSERT INTO student_events(eventsid, studentid) VALUES ('$id','$studentName') ";
				
				$insertToStudentEvents = $bdd->prepare( $insertToStudentEvent ); // We must this line to insert values into table!!!!!
				if ($insertToStudentEvents == false) {
					print_r($bdd->errorInfo());
					die ('Erreur prepare insert kavua student_events table');
				}
				
				$insertToStudentEventTable = $insertToStudentEvents->execute(); // We must this line to insert values into table!!!!!
				if ($insertToStudentEventTable == false) {
					print_r($insertToStudentEvents->errorInfo());
					die ('Erreur execute insert kavua useravticity table');
				}

				/////// we want query for convert student id to student name
			$converIdToName="SELECT `name` FROM `student` WHERE `id`= '$studentName'";
			$converIdToName1 = $bdd->prepare($converIdToName); 
			$converIdToName1->execute();
			$converIdToName2 = $converIdToName1->fetch(); // names is 2 arrays and we need to execute them
			$converIdToName2 =  $converIdToName2[0];
			$studentsNamesArray[$test] = $converIdToName2;
			
			}

				/// convert users names array to string and insert to activity table as a string
			$studentString = implode(",", $studentsNamesArray); 

			$sql = "UPDATE `events` SET `studentstring`= '$studentString' WHERE `id`= '$id' ";
			
			$query = $bdd->prepare( $sql );
			if ($query == false) {
				print_r($bdd->errorInfo());
				die ('Erreur prepare update kavua usersString to activity table');
			}
			$sth = $query->execute();
			if ($sth == false) {
				print_r($query->errorInfo());
				die ('Erreur execute update kavua usersString to activity table');
			}


			$id++; // ++ is for insert to StudentEvent
		}



		
}

}

header('Location: index.php');
	
?>