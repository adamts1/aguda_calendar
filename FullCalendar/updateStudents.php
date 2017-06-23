<?php
// This file are getting values from index.php and returning to index.php while updating activity
require_once('bdd.php');


include "connectdb.php";   
include "connectdb2.php";   

?>



<head>	

	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="https://rawgit.com/dbrekalo/attire/master/dist/css/build.min.css">-->
	<!-- We don't want to use the line above because than it will change the botstrap in every update -->
	<!--<script src="https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js"></script>--> 
	<!-- We don't want to use the line above because than it will be include twice -->
	<link rel="stylesheet" href="dist/fastselect.min.css">
	<script src="dist/fastselect.standalone.js"></script>

	<style>
			.fstElement { font-size: 1.2em; }
			.fstToggleBtn { min-width: 16.5em; }
			.submitBtn { display: none; }
			.fstMultipleMode { display: block; }
			.fstMultipleMode .fstControls { width: 100%; }
	</style>

</head>

<body>


	
<?php
 if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){ // $_POST['Event'] came from index.php in the event render function through ajax
	
	$start = $_POST['Event'][0];
	$end = $_POST['Event'][1];
	$id = $_POST['Event'][2]; 

// echo $start;
// echo $end;
// echo $id;
// echo $identity;



  
   ?>
       

			<label for="users" class="col-sm-2 control-label">תלמידים</label>
					<div class="col-sm-10">
					<select class="multipleSelect" name="students_known[]" multiple name="language">
					<?php
					$result = mysql_query("SELECT `studentid` FROM `student_events` WHERE `eventsid`= '$id'") or die(mysql_error()); //query for all the students in this activity
							$num_rows = mysql_num_rows($result);
							$students_language = [];
							$i=0;
							while($row = mysql_fetch_assoc($result)) { // Loop to change the array format.
								$students_language[$i] = $row['studentid']; ?>			 
								<?php
								$i++;
							} 
					$studentsFromActivity=$students_language;
					if($authorizationLevel == '2'){
					$allAvailableStudents = mysql_query("SELECT P.id, P.nickname FROM student P
                                                         JOIN center C ON P.centerid =C.id
                                                         JOIN supervisor S2 ON C.id = S2.centerid
                                                         WHERE (P.id NOT IN (SELECT DISTINCT S.id 
														 FROM student S, student_events SE, events E 
													     WHERE S.id=SE.studentid AND SE.eventsid = E.id 
														 AND SE.eventsid IN (SELECT `id` FROM events 
														 WHERE start <= '$start' AND end >= '$end'))) 
														 AND S2.id = '$identity'
														 OR (P.id IN 
					                                     (SELECT DISTINCT S.id 
														 FROM student S, student_events SE, events E 
					                                     WHERE S.id=SE.studentid 
														 AND SE.eventsid = E.id AND SE.eventsid = '$id'))");

					}

					if($authorizationLevel == '1'){
					$allAvailableStudents = mysql_query("SELECT id, nickname FROM student 
					JOIN student_events SE ON student.id =SE.studentid
					WHERE SE.eventsid= '$id' ");
						
					} 
					// $allAvailableStudents = all students that not in other activity at the same time or less. this query will show student even if there is at least 1 minutes that he is free. and will show the students that inside this activity
					$i=0;
					while($studentsFromList = mysql_fetch_array($allAvailableStudents)) { // loop for mark the users that in this activity
						if(in_array($studentsFromList["id"],$studentsFromActivity)) 
							$str_flag = "selected";
						else $str_flag="";
						?>
						<option value="<?=$studentsFromList["id"];?>" <?php echo $str_flag; ?>><?=$studentsFromList["nickname"];?></option>
						<!-- 	We want to display students nickName but to send studentId  -->
						<?php
						$i++;
					}
					?>
					</select>
						<script>
							$('.multipleSelect').fastselect(); //script to make nice multiple select
						</script>
					</div>
				  </div>


				  

 <?php } ?>


 
 </body>