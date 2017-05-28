<?php
header('Content-Type: text/html; charset=utf-8');
require_once('bdd.php');
include "connectdb.php";   
include "connectdb2.php";   

session_start(); // This session is for reading __id session from yii
if (empty($_SESSION['__id'])) { // If there is no active session
	$identity= "you nedd to connect with your Password username";
	$authorizationLevel = "0";
}
else{ // If there is active session
	$identity = $_SESSION['__id'];
	$sqlForAuthoriaztion = "SELECT `item_name` FROM `auth_assignment` WHERE `user_id`=$identity";
	$reqForAuthoriaztion = $bdd->prepare($sqlForAuthoriaztion); // $sql came from value_from_filter.php
	$reqForAuthoriaztion->execute();
	$eventsForAuthoriaztion = $reqForAuthoriaztion->fetch();
	$valueForAuthoriaztion =  $eventsForAuthoriaztion[0];
	if($valueForAuthoriaztion== "admin"){
		$authorizationLevel = '1'; // mega supervisor authorization
	}elseif($valueForAuthoriaztion== "pro"){
     			$authorizationLevel = '2'; // supervisor full authorization -> CRUD
	}
	else{
		$authorizationLevel = '3'; // teacher -> View Only
	}
}
echo $authorizationLevel;
//////////setting session into variable if exist ////////////
if (empty($_SESSION['eventsId'])) { // If there is no active session that came from getvalue.php
$eventsIdFromSession = "0";
}
else{
	$eventsIdFromSession = $_SESSION['eventsId']; // If there is active session that came from getvalue.php
}
echo $eventsIdFromSession; // print the activityId from session

if (empty($_SESSION['start'])) { // If there is no start time active session that came from getvalue.php
		$activityStartTimeFromSession = "2000-01-01 00:00:01";
	}
	else{
		$activityStartTimeFromSession = $_SESSION['start']; // If there is start time active session that came from getvalue.php
	}

	if (empty($_SESSION['end'])) { // If there is no start time active session that came from getvalue.php
		$activityEndTimeFromSession = "2020-01-01 00:00:02";
	}
	else{
		$activityEndTimeFromSession = $_SESSION['end']; // If there is start time active session that came from getvalue.php
	}
			echo $activityEndTimeFromSession;
			echo $activityStartTimeFromSession ;


///////////////////////////////

$req = $bdd->prepare($sql); // $sql came from connectdb2.php
$req->execute();
$events = $req->fetchAll();

		// The "if" end "else" are for the filter
// $sqlValueToSearch came from connectdb2.php
	if($sqlValueToSearch=="0"){ // In case the user didn't select nothing in the second filter
		$secondFilterValue = "נתון"; // This variable goes to the filter
		$chosen = ""; // This variable goes to the filter
	}
	else{ // $selectSqlValueToSearch came from connectdb2.php
		$selectSqlValueToSearch = $bdd->prepare($sqlValueToSearch);  // In case the user selected something in the second filter
		$selectSqlValueToSearch->execute();
		$selectsSqlValueToSearch = $selectSqlValueToSearch->fetch(); 
		$secondFilterValue =  $selectsSqlValueToSearch[0];
		$chosen = ""; // This variable goes to the filter	
	}




function filterTable($sql)
 {
  $connect = mysqli_connect("localhost","root","","adam_project");
  $filter_Result = mysqli_query($connect,$sql);
  return $filter_Result;
 }




?>

  
<style>

  .fstElement { font-size: 1.2em; }
  .fstToggleBtn { min-width: 16.5em; }
  .submitBtn { display: none; }
  .fstMultipleMode { display: block; }
  .fstMultipleMode .fstControls { width: 100%; }
</style>

<!DOCTYPE html>





<html lang="en">

<head>

	
	
	


    <link rel="stylesheet" href="dist/fastselect.min.css">
    <script src="dist/fastselect.standalone.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://rawgit.com/dbrekalo/attire/master/dist/css/build.min.css">
    <script src="https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js"></script>

    <!--select2-->
    <link rel="stylesheet" href="dist/fastselect.min.css">  
    <script src="dist/fastselect.standalone.js"></script>
    <!---->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>שיבוץ שיעורים</title>

		



    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	  <link href='css/fullcalendar.css' rel='stylesheet' />


	
	

    <script>

function showUser(str) {
 
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","index.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>


    <!-- Custom CSS -->

		<style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
	#calendar {
		max-width: 2000px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>
 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <!-- 4(LAST) FILTER - here html botton and input send as POST up to function 1/2/3 -->
<!--
<div style ="float:right;margin-right: 120px;">
<form action="index.php" method="post">
<input type="text" name="valueToSearch" placeholder="value to search" style="float: right;">                      
<input type="submit" name="search" value="חפש">
</form>
</div>-->
 <!-- ajax of th multiple search PART2 -->
<?php include "connectdb.php"; ?>
<script type="text/javascript">
function getData(val)
{
	$.ajax({
		type:"POST",
		url:"get_Data.php",
    data: 'fatherFilterValue='+val,		
		success: function(data){
		$("#mainselection").html(data);
		}});

		}

</script>

<!-- ajax PART2 done here-->

<!-- MULTIPLE SEARCH PART 1 -->
<!--<div id="divfilters"  name="divfilters" >-->

<form action="index.php" method="get">
<!--<div style="float:right;margin-right:700px;">-->
<select id="mainselection"   name="valueToSearch" class="finspecific"   dir="rtl">
<!-- $secondFilterValue & chosen declared in the begining of this page	-->
<option value="0"><?php echo $secondFilterValue ?></option> 
</select>
<select id ="mainselection" class="findbypos"  name="titleToSearch" onChange="getData(this.value);"  dir="rtl">
	<!-- $firstFilterValue declared in value_from_filter.php	-->
<option value="0"><?php echo $chosen . "" .$firstFilterValue ?></option> 	
<?php if($authorizationLevel == '1') {?>
<option value="1">מרכזים</option>
<?php } ?>
<option value="2">מיקום</option>
</select>
<br>
<br>
<button value="submit" class="filter" id="find">חפש</button>
</div>
<input type="button" class="unfilter" value="נקה סינון" id="clearfind" onclick="location.href = 'http://localhost/a_p/Fullcalendar/';">
</div>
 <!-- MULTIPLE SEARCH PART 1 done here-->
</div>
</form>	

  <!-- FILTER DONE -->
 

  
    <!-- Page Content -->
  <div class="container">

        <div class="row">
									<?php if($authorizationLevel != '1' && $authorizationLevel != '2' && $authorizationLevel != '3'){ //if the user is not sign in -> ALL the fields in filter be disabled and calendar will destroyed

            
}else{?>

               
            <div class="col-lg-12 text-center">
                <h2>מערכת שיבוץ שיעורים</h2>
               <p class="lead"></p>
                <div id="calendar" class="col-centered">
                </div>   
<?php } ?>

            </div>
			
        </div>

				

        
				
        <!-- /.row -->
		
			<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">הוספת שיבוץ</h4>
			  </div>
			  <div class="modal-body">


						<div class="form-group">
					<label for="centerid" class="col-sm-2 control-label">מרכז</label>
					<div class="col-sm-10">
					  <select id="centerId" class="form-control"  name="centerId" dir="rtl">
						             					<?php
							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
 							$sql = "SELECT id, name FROM center";
 							$result = mysql_query($sql);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['name'] ."</option>";
 							}
 					?>
         	</select>
					</div>
					</div>

											<div class="form-group">
					<label for="courseId" class="col-sm-2 control-label">מקצוע לימוד</label>
					<div class="col-sm-10">
					  <select id="courseId" class="form-control"  name="courseId" dir="rtl">
						             					<?php
							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
 							$sql = "SELECT id, 	coursename FROM course";
 							$result = mysql_query($sql);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['coursename'] ."</option>";
 							}
 					?>
         	</select>
					</div>
					</div>

				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">תיאור שיבוץ</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
					</div>
          </div>

					<div class="form-group">
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
 							$sql = "SELECT id, name FROM location";
 							$result = mysql_query($sql);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['name'] ."</option>";
 							}
 					?>
         	</select>
					</div>
				  </div>


<!--/////////////////////teacher-dropdown////////////////////-->

					<div class="form-group">
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
              FROM teacher
              JOIN user
              ON teacher.id=user.id;";
 							$result = mysql_query($query);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['username'] ."</option>";
 							}
 					?>
					 

         	</select>
					</div>
				  </div>
<!--////////////////////////////teacher-dropdown-end////////////////////////////-->
				<!--   Create studentactivity Multiple Select - nice bootrsap code (link folders: doc, dist and demo)   -->
					<div class="form-group">
					<label for="students" class="col-sm-2 control-label">תלמידים</label>
					<div class="col-sm-10">
					<select class="multipleSelect" name="students_known[]" multiple name="language">
					<?php
           $allAvailableUsers = mysql_query("SELECT `id`, `name` FROM `student` 
					 WHERE `id` NOT IN (SELECT DISTINCT S.id FROM student S, student_events SE, events E 
					 WHERE S.id=SE.studentid AND SE.eventsid = E.id AND SE.eventsid 
					 IN (SELECT `eventsid` FROM `events` WHERE start <= '$activityStartTimeFromSession' AND end >= '$activityEndTimeFromSession'))");		
					 $i=0;
					while($userFromList = mysql_fetch_array($allAvailableUsers)) {
						?>
						<option value="<?=$userFromList["id"];?>"><?=$userFromList["name"];?></option>
						<!-- 	We want to display userName but to send userNumber  -->
						<?php
						$i++;
					} ?>
					</select>
						<script>
									$('.multipleSelect').fastselect(); //script code for multiple select
						</script>
					</div>
				  </div>
	  
				

					<!--//////////////////////////////////-->
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">צבע</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color" dir="rtl">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; כחול כהה</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; טורקיז</option>
						  <option style="color:#008000;" value="#008000">&#9724; ירוק</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; צהוב</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; כתום</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; אדום</option>
						  <option style="color:#000;" value="#000">&#9724; שחור</option>
						  
						</select>
					</div>
				  </div>

					
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
					  <input type="hidden" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>	
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
					  <input type="hidden" name="end" class="form-control" id="end" readonly>
					</div>
				  </div>
					
					<div class="form-group">
				<label for="comment" class="col-sm-2 control-label">מספר שבועות</label>		
				          	<div class="col-sm-10">
		
					  <input type="date" name="quantity" class="form-control" id="end" >
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
	<!-- edit -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">

			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">עריכת שיבוץ </h4>
			  </div>

			  <div class="modal-body">
				  <div class="form-group">
					<label for="locationId" class="col-sm-2 control-label">כיתת לימוד</label>
					<div class="col-sm-10">
					  <select id="locationId" class="form-control"  name="locationId" dir="rtl">
						<?php
            
            $mysqlserver="localhost";
            $mysqlusername="root";
            $mysqlpassword="";
            $link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
            
            $dbname = 'adam_project';
            mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
            
            $cdquery="SELECT id, name FROM location";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
            
            while ($cdrow=mysql_fetch_array($cdresult)) {
 							echo "<option value='" . $cdrow['id'] ."'>" . $cdrow['name'] ."</option>";
			
			
			
                
            
            }  ?>
                </p>
				
    
        </select>
					</div>
				  </div>	

				  <div class="form-group">
					<label for="centerid" class="col-sm-2 control-label">מרכז</label>
					<div class="col-sm-10">
					  <select id="centerId" class="form-control"  name="centerId" dir="rtl">
						<?php
            
            $mysqlserver="localhost";
            $mysqlusername="root";
            $mysqlpassword="";
            $link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
            
            $dbname = 'adam_project';
            mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
            
            $cdquery="SELECT id, name FROM center";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
            
            while ($cdrow=mysql_fetch_array($cdresult)) {
 							echo "<option value='" . $cdrow['id'] ."'>" . $cdrow['name'] ."</option>";
			
			
			
                
            
            }  ?>
                </p>
				<?php
            ?>
    
        </select>
					</div>
				  </div>	

					<div class="form-group">
					<label for="teacherId" class="col-sm-2 control-label">מורה מלמד</label>
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
              FROM teacher
              JOIN user
              ON teacher.id=user.id;";
 							$result = mysql_query($query);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['username'] ."</option>";
 							}
 					?>
					 

         	</select>
					</div>
				  </div>

					<div class="form-group">
					<label for="courseId" class="col-sm-2 control-label">מקצוע לימוד</label>
					<div class="col-sm-10">
					  <select id="courseId" class="form-control"  name="courseId" dir="rtl">
						<?php
            
            	
							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
 							$query="SELECT id, coursename FROM course";

 							$result = mysql_query($query);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option value='" . $row['id'] ."'>" . $row['coursename'] ."</option>";
 							}
 					?>
					 

         	</select>
					</div>
				  </div>


				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">תיאור שיבוץ</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
					</div>
				  </div>

					<!--   Update studentEvents Multiple Select - nice bootrsap code (link folders: doc, dist and demo)   -->
					<div class="form-group">
					<label for="student" class="col-sm-2 control-label">תלמידים</label>
					<div class="col-sm-10">
					<select class="multipleSelect" name="students_known[]" multiple name="language" id="studentNumber2" >
					<?php
									
							$result = mysql_query("SELECT `studentid` FROM `student_events` WHERE `eventsid`= '$eventsIdFromSession' ") or die(mysql_error());					
						// $activityIdFromSession came from the beginning of this page
								$num_rows = mysql_num_rows($result);
						   	$students_language = [];
						  	$i=0;
									while($row = mysql_fetch_assoc($result)) {
								$students_language[$i] = $row['studentid']; ?>
								 
								<?php
								$i++;
							} 

					$studentsFromEvents=$students_language;
					$allAvailableStudents = mysql_query("SELECT `id`, `name` 
					FROM `student` WHERE (`id` NOT IN (SELECT DISTINCT S.id FROM student S, student_events SE, events E 
					WHERE S.id=SE.studentid AND SE.eventsid = E.id AND SE.eventsid 
					IN (SELECT `id` FROM `events` WHERE start <= '$activityStartTimeFromSession' AND end >= '$activityEndTimeFromSession'))) 
					OR (`id`IN (SELECT DISTINCT S.id FROM student S, student_events SE, events E 
					WHERE S.id=SE.studentid AND SE.eventsid = E.id AND SE.eventsid = '$eventsIdFromSession'))");
					$i=0;
					while($studentsFromList = mysql_fetch_array($allAvailableStudents )) {
						if(in_array($studentsFromList["id"],$studentsFromEvents)) 
							$str_flag = "selected";
						else $str_flag="";
						?>
						<option value="<?=$studentsFromList["id"];?>" <?php echo $str_flag; ?>><?=$studentsFromList["name"];?></option>
						<!-- 	We want to display userName but to send userNumber  -->
						<?php
						$i++;
					}
					?>
					</select>
						<script>
									$('.multipleSelect').fastselect(); //script code for multiple select
						</script>
					</div>
				  </div>
			
           

				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">צבע</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color" dir="rtl">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; כחול כהה</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; טורקיז</option>
						  <option style="color:#008000;" value="#008000">&#9724; ירוק</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; צהוב</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; כתום</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; אדום</option>
						  <option style="color:#000;" value="#000">&#9724; שחור</option>
						  
						</select>
					</div>
				  </div>

						<div class="form-group">
					<label for="start" class="col-sm-2 control-label"></label>
				<div class="col-sm-10">

				  <input type="input" name="start" class="form-control" id="start" placeholder="start">
				</div>
				  </div>

											<div class="form-group">

				<label for="groupNumber" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
					  <input type="hidden" name="groupNumber" class="form-control" id="groupNumber" placeholder="groupNumber">
					</div>
				  </div>


						<div class="form-group" > 
						<div class="col-sm-offset-2 col-sm-10" >
						  <div class="checkbox"  >
							<label class="text-danger"><input type="checkbox" id="home"   name="updateAll" ><p style="color:green;"  >עדכון כל פעיליוית מסוג זה</p></label>
						  </div>
						</div>
					</div>




					
				

				    <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> מחק שיבוץ זה בלבד</label>
						  </div>
						</div>
					</div>

				
					

				 <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">

							<label class="text-danger"><input type="checkbox" id="home" name="deleteAll" > מחק כל פעילות מסוג זה</label>
							<script>
						$("#home").click(function() {
  				  // this function will get executed every time the #home element is clicked (or tab-spacebar changed)
  				  if($(this).is(":checked")) // "this" refers to the element that fired the event
  				  {
     		   alert('שים לב, כעת סימנת שינוי קבוע !!');
   					 }
						});
					</script>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
			</div> 
		 </div>
		</div>
  </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	<script src='js/lang-all.js'></script> 
	
	
	<script>

	$(document).ready(function() {
		var d = new Date();
		var initialLangCode = 'he';
		defaultDate: d,

		
		$('#calendar').fullCalendar({
			header: {
				left: 'next  today prev ',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},

			buttonText: { // Values dor cuttons 
                    today: 'היום',
                    month: 'חודשי',
                    week: 'שבועי',
                    day: 'יומי'
      },



			defaultDate: d,
			defaultView: 'agendaWeek', // Default view is now agendaWeek instead of month. we can allso use agendaDay

			lang: initialLangCode,
		


			eventLimit: true, // allow "more" link when too many events
      minTime: "08:00:00", // Min Time of every day
      maxTime: "19:00:00", // Max time of every day

			// nowIndicator: true,
			selectHelper: true,
	<?php if($authorizationLevel == '1' || $authorizationLevel == '2' ){ //if the user is admin
			?>
				editable: true,
				selectable: true,
			<?php }
			else{  // if the user is not admin
			?>
				editable: false,
				selectable: false,
			<?php }	?>
			
			select: function(start, end) {
					$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				var start = moment(start).format('YYYY-MM-DD HH:mm:ss'); // new event start time
						$.ajax({ // send start time to getvalue.php while create new activity
	  		       type: "POST",
    		        url: 'getvalue.php',
  	           data: { start : start },
    	          success: function(data)
									{
											//alert("success!");
									}
            	});

				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				var end = moment(end).format('YYYY-MM-DD HH:mm:ss'); // new event end time
						$.ajax({ // send end time to getvalue.php while create new activity
	  		       type: "POST",
    		        url: 'getvalue.php',
  	           data: { end : end },
    	          success: function(data)
									{
											//alert("success!");
									}
            	});

				
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			}, //provid the exist value when edut by click
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit #start').val(event.start); 
					$('#ModalEdit #locationid').val(event.locationid);
					$('#ModalEdit #groupNumber').val(event.groupNumber); 
					$('#ModalEdit #teacherid').val(event.teacherid); 
					$('#ModalEdit #centerid').val(event.centerid);
					$('#ModalEdit #courseid').val(event.courseid);

					 	var eventsidajax = event.id; // event activityId
						 $.ajax({ // send activityId to getvalue.php while edit existing activity
	  		       type: "POST",
    		        url: 'getvalue.php',
  	           data: { eventsID : eventsidajax },
    	          success: function(data)
									{
											//alert("success!");
									}
            	});
						
						var start = event.start.format('YYYY-MM-DD HH:mm:ss'); // event start time
						$.ajax({ // send start time to getvalue.php while edit existing activity
	  		       type: "POST",
    		        url: 'getvalue.php',
  	           data: { start : start },
    	          success: function(data)
									{
											//alert("success!");
									}
            	});

							var end = event.end.format('YYYY-MM-DD HH:mm:ss'); // event end time
						$.ajax({ // send end time to getvalue.php while edit existing activity
	  		       type: "POST",
    		        url: 'getvalue.php',
  	           data: { end : end },
    	          success: function(data)
									{
											//alert("success!");
									}
            	});
					$('#ModalEdit').modal('show');
				});

          element.find('.fc-title').append("<br/><b>פעילות: </b>" + event.id + "</br>"); // We can change event.comment to what we want disply

			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
		?>
				{
					id: '<?php echo $event['id']; ?>',
					locationid: '<?php echo $event['locationid']; ?>',
					title: '<?php echo $event['title']; ?>',
					centerid: '<?php echo $event['centerid']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
					teacherid: '<?php echo $event['teacherid']; ?>',
					groupNumber: '<?php echo $event['groupNumber']; ?>',
					courseid: '<?php echo $event['courseid']; ?>',

						<?php
					$id = $event['id']; // Insert the local activityId into variable 
					
					$sqli = "SELECT `studentid` FROM `student_events` WHERE `eventsid`= $id "; //
					$reqi = $bdd->prepare($sqli); // initilazing the query
					$reqi->execute(); // initilazing the query
					$eventsi = $reqi->fetchAll(); // initilazing the query and foreach function will output the values

					foreach($eventsi as $eventi): ?>
					name: '<?php echo $eventi['studentid']; ?>',
					<?php endforeach; ?>

				

					textColor: 'black', // I added this for black text color instead of white
					borderColor: 'black', // I added this for black border color instead of nothing
				},
			<?php endforeach; ?>
			]
		});

		<?php if($authorizationLevel == '3'){ //if the user is not admin-> ALL the fields in ModalAdd and ModalEdit will be disabled
			?>
				//$('#calendar').fullCalendar('destroy'); // In case we want to destroy calendar after he initialized
				$('#ModalAdd').find('input, textarea, button, select').prop('disabled','disabled');
				$('#ModalEdit').find('input, textarea, button, select').prop('disabled','disabled');
			<?php } ?>
				<?php if($authorizationLevel == '0' ){ //if the user is not sign in -> ALL the fields in filter be disabled and calendar will destroyed
			?>
				//$('#calendar').fullCalendar('destroy'); // In case we want to destroy calendar after he initialized
				$('#filter').find('input, textarea, button, select').prop('disabled','disabled');
				$('#calendar').fullCalendar('destroy'); // In case we want to destroy calendar after he initialized
			<?php } ?>

		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
		
	});

</script>

</body>

</html>