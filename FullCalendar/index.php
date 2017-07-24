<?php
header('Content-Type: text/html; charset=utf-8');
require_once('bdd.php');
include "connectdb.php";   
include "connectdb2.php";   


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

  


<!DOCTYPE html>





<html lang="en">

<head>

	
	
	


    <link rel="stylesheet" href="dist/fastselect.min.css">
    <script src="dist/fastselect.standalone.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://rawgit.com/dbrekalo/attire/master/dist/css/build.min.css">
		<link rel="stylesheet" href="dist/fastradio.css"> <!-- radio button -->
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

  <style>

   .fstElement { font-size: 1.2em; }
   .fstToggleBtn { min-width: 16.5em; }
   .submitBtn { display: none; }
   .fstMultipleMode { display: block; }
   .fstMultipleMode .fstControls { width: 100%; }

    body 
		{		
    padding-top: 0px;
		padding-right: 0px;
		padding-left: 0px;
		margin-right:0px;
		margin-left:0px;	
		width: 100%;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
	#calendar {
		max-width: 100%;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}




    </style>
 

 
</head>

<body>
 

<script type="text/javascript">
function getData(val)
{
	$.ajax({
		type:"POST",
		url:"get_data.php",
    data: 'fatherFilterValue='+val,		
		success: function(data){
		$("#mainselection").html(data);
		console.log(val);

		}});

		}

</script>





<form action="index.php" method="get">
<div id="filter" style="float:right;margin-right:95px;">
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
<?php if($authorizationLevel == '2') {?>
<option value="2">מיקום</option>
<option value="3">מורים</option>
<option value="4">מקצועות</option>
<option value="5">תלמידים</option>
<?php } ?>

</select>
<br>
<br>

</div>
<div>
<button value="submit" class="filter">סנן</button>
</div>
<div>
<input type="button" class="unfilter" value="נקה סינון" id="clearfind" onclick="location.href = 'http://localhost/a_p/Fullcalendar/';">
</div>
 <!-- MULTIPLE SEARCH PART 1 done here-->
</form>	

  <!-- FILTER DONE -->
 

  
    <!-- Page Content -->
  <div class="container">

        <div class="row">
									<?php if($authorizationLevel != '1' && $authorizationLevel != '2' && $authorizationLevel != '3'){ //if the user is not sign in -> ALL the fields in filter be disabled and calendar will destroyed

            
}else{?>

               <br>
               <br>
               <br>
						
            <div class="col-lg-12 text-center">
						
							
                <h2>מערכת שיבוץ שיעורים</h2>

               <p class="lead"></p>
                <div id="calendar" class="col-centered"> </div>   
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
			  

     <!--/////////////////////////-->
 <div class="modal-body">


						<div class="form-group">
					<label for="centerid" class="col-sm-2 control-label">מרכז</label>
					<div class="col-sm-10">
					  <select id="centerId" class="form-control"  name="centerId" dir="rtl"  type='hidden'>
						             					<?php

							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
 							$sql = "SELECT C.id, C.name FROM center AS C
							        JOIN supervisor AS S ON C.id =S.centerId
                      WHERE  S.id = '$identity'";
							
 							$result = mysql_query($sql);
 
 							
 							while ($row = mysql_fetch_array($result)) {
 							echo "<option   value='" . $row['id'] ."'>" . $row['name'] ."</option>";
 							}
 					?>
         	</select>
					</div>
					</div>
			 <!--//////////////////////////////-->

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
 							$sql = "SELECT C.id, 	C.coursename FROM course AS C 
                      JOIN course_center AS CC ON C.id =CC.courseid 
                      JOIN center AS C2  ON CC.centerid =C2.id 
                      JOIN supervisor AS S ON C2.id =S.centerId
                      WHERE  S.id = '$identity' ";
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
					  <input type="text" name="title" class="form-control" id="title" placeholder="(תיאור השיבוץ (הזנה בעברית בלבד"  onkeyup="letterOnly(this)">
													<!--<script>
					function letterOnly(input) {
						var regex = /[^א-ת ]/gi;
						input.value = input.value.replace(regex,"");
					}
					</script>-->
					</div>
          </div>
				 <div class="form-group" id="createLocation" ></div>
			   <div class="form-group" id="createTeacher" ></div>
			   <div class="form-group" id="createStudents" ></div>

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

					
				  <!--<div class="form-group">
					<label for="start" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">-->
					  <input type="hidden" name="start" class="form-control" id="start" readonly>
					<!--</div>
				  </div>	
				  <div class="form-group">-->
					<!--<label for="end" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">-->
					  <input type="hidden" name="end" class="form-control" id="end" readonly>
					<!--</div>
				  </div>-->
					
					<div class="form-group">
				<label for="comment" class="col-sm-2 control-label">מספר שבועות</label>		
				          	<div class="col-sm-10">
		
					  <input type="date" name="quantity" class="form-control" id="quantity">
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">ביטול</button>
				<button type="submit" class="btn btn-primary"/>שמור שינויים</button>
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
					  <select id="locationid" class="form-control"  name="locationId" dir="rtl">
						<?php
            $mysqlserver="localhost";
            $mysqlusername="root";
            $mysqlpassword="";
            $link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
            
            $dbname = 'adam_project';
            mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
             if( $authorizationLevel == '2' )
						 {  
               

						   $cdquery= "SELECT L.id, L.name FROM location AS L
							            JOIN center AS C  ON L.centerid =C.id 
                          JOIN supervisor AS S ON C.id =S.centerId
                          WHERE  S.id = '$identity'";

													

              

						 }else{
                 ////////// provide location according to filter search if eden israeli
							 $cdquery= "SELECT id, name FROM location  
							            
                          WHERE  centerid =  '$valueToSearch'";
						 }
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
					  <select id="centerid" class="form-control"  name="centerId" dir="rtl">
						<?php
            
            $mysqlserver="localhost";
            $mysqlusername="root";
            $mysqlpassword="";
            $link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
            
            $dbname = 'adam_project';
            mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
             if( $authorizationLevel == '2' ){  
            $cdquery="SELECT C.id, C.name FROM center AS C
							        JOIN supervisor AS S ON C.id =S.centerId
                      WHERE  S.id = '$identity'";
						 }else {
               ////////// provide location according to filter search if eden israeli
							 $cdquery="SELECT id, name FROM center  
                      WHERE  id = '$valueToSearch'";
						 }
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
					<label for="teacherid" class="col-sm-2 control-label">מורה מלמד</label>
					<div class="col-sm-10">
					  <select id="teacherid" class="form-control"  name="teacherId" dir="rtl">
						<?php
            
            	
							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
							if( $authorizationLevel == '2' ) 
							{  
 							$query = "SELECT user.username, teacher.id
                        FROM user
                        JOIN teacher ON teacher.id=user.id
							          JOIN center AS C  ON teacher.centerid =C.id 
                        JOIN supervisor AS S ON C.id =S.centerId
                        WHERE  S.id = '$identity'";
							}else{

									$query = "SELECT user.username, teacher.id
                        FROM user
                        JOIN teacher ON teacher.id=user.id
												WHERE  teacher.centerid = '$valueToSearch'";
                        


							}
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
					  <select id="courseid" class="form-control"  name="courseId" dir="rtl">
						<?php
            
            	
							$mysqlserver="localhost";
 							$mysqlusername="root";
 							$mysqlpassword="";
 							$link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
 							$dbname = 'adam_project';
 							mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
							mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew
							if( $authorizationLevel == '2' ) 
							{  
 							$query="SELECT C.id, 	C.coursename FROM course AS C 
                      JOIN course_center AS CC ON C.id =CC.courseid 
                      JOIN center AS C2  ON CC.centerid =C2.id 
                      JOIN supervisor AS S ON C2.id =S.centerId
                      WHERE  S.id = '$identity'";
							}else{
								$query="SELECT C.id, 	C.coursename FROM course AS C 
                      JOIN course_center AS CC ON C.id =CC.courseid  
                      WHERE  CC.centerid = '$valueToSearch'";
							     }
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
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title" onkeyup="letterOnly(this)"  required>
											<script>
					function letterOnly(input) {
						var regex = /[^0-9א-ת ]/gi;
						input.value = input.value.replace(regex,"");
					}
					</script>
					</div>
				  </div>

					<!--   Update studentEvents Multiple Select - nice bootrsap code (link folders: doc, dist and demo)   -->
					<div class="form-group" id="updateStudents" ></div>

			
           

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

					<input type="hidden" name="id" class="form-control" id="id">


					<div class="form-group">
					<label for="studentString" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
					  <input type="hidden" name="studentString" class="form-control" id="studentString">
					</div>
				  </div>


								     <!--<div class="container" style = "width:530px;">-->
						<!--<ul>
 					 <li>
				 <input type="radio" id="f-option" name="delete" value="1">
  			  <label for="f-option"  style = "padding-left:59px; color:red;">מחק פעילות</label>
					<div class="check"></div>
					</li>

					<li>
						<input type="radio"  id="s-option" value="2"  name="delete">
								 <label for="s-option"  style = "padding-left:20px ; color:red;"> מחק פעילות קבועה</label> 
								<div class="check"></div>
									</li>
															<script>
														
						$("#s-option").click(function() {
  				  // this function will get executed every time the #home element is clicked (or tab-spacebar changed)
  				  if($(this).is(":checked")) // "this" refers to the element that fired the event
  				  {
     		   alert('שים לב, פעולה זו תמחק את כל השיבוצים מסוג זה !!');
   					 }
						});
					</script>
					  <li>
    <input type="radio" id="t-option" value = "3" name="delete">
    <label for="t-option" style = "padding-left:60px; color:green;">עדכון קבועה</label>
		 <div class="check"><div class="inside"></div></div>
  </li>
											<script>
														
						$("#t-option").click(function() {
  				  // this function will get executed every time the #home element is clicked (or tab-spacebar changed)
  				  if($(this).is(":checked")) // "this" refers to the element that fired the event
  				  {
     		   alert('שים לב, כעת סימנת שינוי קבוע !!');
   					 }
						});
					</script>
</ul>-->
<!--</div>-->


</div>
				<script>
						$( ".updateButtonCalendar" ).click(function() {
							console.log('adam');
						});
				</script>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
				<!--<button type="submit" class="btn btn-primary" onclick="myFunction()">שמור שינויים</button>-->
				<button type="button" class="btn btn-primary updateButtonCalendar" data-toggle="modal" data-target="#updateModalCalendar">עדכון</button>
				<button type="button"  class="btn btn-primary deleteButtonCalendar" data-toggle="modal" data-target="#deleteModalCalendar">מחק</button>

				  <!-- Modal -->
				<div class="modal fade" id="deleteModalCalendar" role="dialog">
					<div class="modal-dialog">
					
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">מחיקת פעילות</h4>
							</div>
							<div class="modal-body">
									<button  name="delete" value="1" type="submit" class="btn btn-primary">מחק פעילות </button>
									<button  name="delete" value="2" type="submit" class="btn btn-primary" onclick="myFunction()">מחק את כל הפעילויות מסוג זה</button>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>


				<div class="modal fade" id="updateModalCalendar" role="dialog">
					<div class="modal-dialog">
					
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">עדכון פעילות</h4>
							</div>
							<div class="modal-body">
									<button type="submit" class="btn btn-primary" onclick="myFunction()"> עדכן פעילות </button>
									<button value = "3" name="delete" type="submit" class="btn btn-primary" onclick="myFunction() ">עדכן את כל הפעילויות מסוג זה</button>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>



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
  <!--<script src='js/lang-all.js'></script> 	-->
	<script src='js/he.js'></script>
	<script>



	$(document).ready(function() {
		var d =  new Date();
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



			defaultView: 'agendaWeek', // Default view is now agendaWeek instead of month. we can allso use agendaDay

			lang: initialLangCode,
			hiddenDays:[6],

      
      navLinks: true, // we can click day/week (only if weekNumbers is true) numbers to navigate to spesific view 
			// isRTL: true,
			//businessHours: true, // display business hours // If we want gray background color for sunday and saturday 
			eventLimit: true, // allow "more" link when too many events
			weekends: true, // If we don't eant to display Saturday and Sunday
			hiddenDays: [6], // hide Saturday
			fixedWeekCount: true, // False if we want 4.5 - 6 rows of calendar instead of default 6
			// weekNumbers: true, // If we want to display week numbers 
			scrollTime: '07:30:00', // The day start at 6:30 instead of 6:00
			minTime: "07:00:00", // Min Time of every day
			maxTime: "18:00:00", // Max time of every day
			displayEventTime : true, // If we want to hide the display of time in every event
			nowIndicator: true, // display a marker indicating the current time
			selectHelper: true,

	

		<?php if($authorizationLevel == '1' ){ //if the user is admin
			?>
				editable: false,
				selectable: false,
			<?php }
			else{  // if the user is not admin
			?>
				editable: true,
				selectable: true,
			<?php }	?>
		
			
				select: function(start, end) {



				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				var start = moment(start).format('YYYY-MM-DD HH:mm:ss'); // new event start time
	

				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				var end = moment(end).format('YYYY-MM-DD HH:mm:ss'); // new event end time
		
				
				Event = [];
				Event[0] = start;
				Event[1] = end;

					$.ajax({ // send array with start and end times to updateUsersAndStudents.php while edit creating new activity
							type: "POST",
							url: 'createStudents.php',
							data: {Event:Event},
							success: function(data)
								{
									$("#createStudents").html(data); // insert the values from createUsersAndStudents.php to createUsersAndStudents div
								}
						});



							$.ajax({ // send array with start and end times to updateUsersAndStudents.php while edit creating new activity
							type: "POST",
							url: 'createLocation.php',
							data: {Event:Event},
							success: function(data)
								{
									$("#createLocation").html(data); // insert the values from createUsersAndStudents.php to createUsersAndStudents div
								}
						});

							$.ajax({ // send array with start and end times to updateUsersAndStudents.php while edit creating new activity
							type: "POST",
							url: 'createTeacher.php',
							data: {Event:Event},
							success: function(data)
								{
									$("#createTeacher").html(data); // insert the values from createUsersAndStudents.php to createUsersAndStudents div
								}
						});
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {

    
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit #start').val(event.start); 
					$('#ModalEdit #locationid').val(event.locationid);
					$('#ModalEdit #groupNumber').val(event.groupNumber); 
					$('#ModalEdit #centerid').val(event.centerid);
					$('#ModalEdit #courseid').val(event.courseid);
					$('#ModalEdit #teacherid').val(event.teacherid);
					// $('#ModalEdit #studentstring').val(event.studentstring);
				

							var id = event.id; // event activityId
			
						
						var start = event.start.format('YYYY-MM-DD HH:mm:ss'); // event start time
			

							var end = event.end.format('YYYY-MM-DD HH:mm:ss'); // event end time
	

						  Event = [];
							Event[0] = start;
							Event[1] = end;
							Event[2] = id;

						$.ajax({ // send array with activityId, start and end times to updateUsersAndStudents.php while edit existing activity
							type: "POST",
							url: 'updateStudents.php',
							data: {Event:Event},
							success: function(data)
								{
									$("#updateStudents").html(data); // insert the values from updateUsersAndStudents.php to updateUsersAndStudents div
								}
						});
					
				
					$('#ModalEdit').modal('show');

				
				});

          // element.find('.fc-title').append("<br/><b>מורה בפעילות: </b>" + event.teacherid ); // We can change event.comment to what we want disply
          element.find('.fc-title').append("<br/><b>תלמידים: </b>" + event.studentstring ); // We can change event.comment to what we want disply

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

			
				{  // This function will remember the values while updating and will set the data that shown 
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
					studentstring: '<?php echo $event['studentstring']; ?>',

				

					textColor: 'black', // I added this for black text color instead of white
					borderColor: 'black', // I added this for black border color instead of nothing
				},
			<?php endforeach; ?>
			]
			
	
		});
		

		<?php if($authorizationLevel == '3' || $authorizationLevel == '1' ){ //if the user is not admin-> ALL the fields in ModalAdd and ModalEdit will be disabled
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