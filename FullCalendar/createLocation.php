	
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
    
					<label for="location" class="col-sm-2 control-label">כיתת לימוד</label>
					<div class="col-sm-10">
					  <select id="locationId" class="form-control"  name="locationId" dir="rtl">
						<?php
							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
 							$sql = "SELECT L.id, L.name FROM location AS L
                            JOIN center AS C  ON L.centerid =C.id 
                            JOIN supervisor AS S ON C.id =S.centerId
                            WHERE  S.id = '$identity' AND L.id NOT IN(
                            SELECT L2.id FROM location AS L2	
                            JOIN events AS E  ON L2.id = E.locationid 
                            Where E.start >= '$start' && E.end <= '$end' OR (E.start <= '$start' AND E.end >= '$end'))";
 							$result = mysql_query($sql);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['name'] ."</option>";
 							}
 					?>
         	</select>
					</div>
				  </div>

                  
						
						<!-- 	We want to display student nickName but to send studentId  -->
				
					</select>
						
					</div>
				  </div>


				  

 <?php 
  }
 ?>


 
 </body>
