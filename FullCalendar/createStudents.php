<?php
// This file are getting values from index.php and returning to index.php while creating new activity
include "bdd.php";
include "connectdb.php"; 
include "session.php"; 
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
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) ){ // $_POST['Event'] came from index.php in the select function through ajax

	$start = $_POST['Event'][0];
	$end = $_POST['Event'][1];
  
  ?>
     
			<label for="students" class="col-sm-2 control-label">תלמידים</label>
					<div class="col-sm-10">
					<select class="multipleSelect" name="students_known[]" multiple name="language">
					<?php
              
					$allAvailableStudents = mysql_query("SELECT P.id, P.name FROM student P
                                             JOIN center C ON P.centerid =C.id
                                             JOIN supervisor  S2 ON C.id = S2.centerid
                                             WHERE P.id NOT IN (SELECT DISTINCT S.id FROM student S, student_events SE, events E 
                                             WHERE S.id=SE.studentid AND SE.eventsid = E.id AND SE.eventsid 
                                             IN (SELECT P2.id FROM events P2 WHERE P2.start >= '2017-05-28 07:30:00' 
                                             AND P2.end <= '2017-05-28 08:00:00')) AND S2.id = '$identity'");
                    
                                            
					// $allAvailableStudents = all students that not in other activity at the same time or less. this query will show user even if there is at least 1 minutes that he is fre
					$i=0;
					while($studentFromList = mysql_fetch_array($allAvailableStudents)) {
						?>
						<option value="<?=$studentFromList["id"];?>"><?=$studentFromList["name"];?></option>
						<!-- 	We want to display student nickName but to send studentId  -->
						<?php
						$i++;
					} ?>
					</select>
						<script>
									$('.multipleSelect').fastselect(); //script code for multiple select
						</script>
					</div>
				  </div>


				  

 <?php 
  }
 ?>


 
 </body>