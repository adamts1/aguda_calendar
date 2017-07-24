	
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
    
					<label for="teacherId" class="col-sm-2 control-label">מורה</label>
					<div class="col-sm-10">
					  <select id="teacherId" class="form-control"  name="teacherId" dir="rtl">
						<?php
							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
 							$query = "SELECT user.username, teacher.id
                            FROM user
                            JOIN teacher ON teacher.id=user.id
						    JOIN center AS C  ON teacher.centerid =C.id 
                            JOIN supervisor AS S ON C.id =S.centerId
                            WHERE  S.id = '$identity' AND teacher.id NOT IN(
                            SELECT T.id FROM teacher AS T	
                            JOIN events AS E  ON T.id = E.teacherid 
                            Where E.start >= '$start' AND E.end <= '$end' OR (E.start <= '$start' AND E.end >= '$end'))";
 							$result = mysql_query($query);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['username'] ."</option>";
 							}
 					?>
					 

         	</select>
					</div>
				  </div>

                   <?php 
  }
 ?>


 
 </body>
