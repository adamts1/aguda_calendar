<?php
require_once('bdd.php');
header('Content-Type: text/html; charset=utf-8');

   ?>

<!--check-------------------------------------------------------->

		<body>

    <form method="post" action="index.php">
			<style>
          div.ex1 {
              direction: rtl;
    position: relative;
    right: 8%;
    font-weight: bold;
    font-style: italic;
          }


       </style>

       
        <div class="ex1">הצג מערכת עבור:</div>
				
<!--filter-->
               <input type="submit" class="form-control1"  name="submit" value="הצג" />

        <select dir="rtl" id="cd" name="cd" class="form-control1"  >
    
   
            <?php
            
            $mysqlserver="localhost";
            $mysqlusername="root";
            $mysqlpassword="";
            $link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
            
            $dbname = 'adam_project';
            mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
            mysql_query("SET NAMES 'utf8'",$link);
            $cdquery="SELECT id, name FROM center";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from events failed: ".mysql_error());
            while ($cdrow=mysql_fetch_array($cdresult)) {

					?>	<option value="<?php echo $cdrow['id'];?>"><?php echo $cdrow['name']; ?></option> 
		


<?php

               
            }   
            ?>
        </select>
    </form>

		<?php

		if ( isset( $_POST['submit'] )  ) {
    //is submitted
    $variable = $_POST['cd'];
    //DO STUFF WITH DATA


?>
<!--filter-->
		<!--check-------------------------------------------------------->

<?php

$sql = "SELECT id, title, start, end, color, centerid, location FROM events WHERE centerid = '$variable' ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

}else {

$sql = "SELECT id, title, start, end, color, centerid, location FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();





}
?>

<!DOCTYPE html>





<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

		



    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />


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

	/*div.fixed {
    position: fixed;
    width: 100px;
    height: 50px;
		right: 100px;
		
    
} 
div.fixed_title {
    position: fixed;
    width: 100px;
    height: 50px;
		right: 500px;
		
    
} 

	div.fixed_submit {
    position: fixed;
    width: 50px;
    height: 40px;
		right: 210px;
    
} */


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

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">

				
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Free Calendar</a>

								
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Menu</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
						<?php		if ( isset( $_POST['submit'] ) ) {

							  $nameofcenter="SELECT name FROM center WHERE id = '$variable'";
								$req1 = $bdd->prepare($nameofcenter);
                 $req1->execute();
								 
                 $result =  $req1->fetch(\PDO::FETCH_ASSOC);
			
		?>
                <h1>  מערכת שעות עבור <?php echo implode($result," ");?></h1><?php }
								 else { ?> <h1> מערכת שיבוץ שיעורים </h1>
                <?php }?>

								 <p class="lead"></p>
                <div id="calendar" class="col-centered">

							
                </div>
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
				<h4 class="modal-title" id="myModalLabel">Add Event</h4>
			  </div>
			  <div class="modal-body">


						<div class="form-group">
					<label for="centerid" class="col-sm-2 control-label">centerid</label>
					<div class="col-sm-10">
					  <input type="text" name="centerid" class="form-control" id="centerid" placeholder="centerid">
					</div>
					</div>

				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
					</div>
          </div>

					<div class="form-group">
					<label for="location" class="col-sm-2 control-label">Location</label>
					<div class="col-sm-10">
					  <input type="text" name="location" class="form-control" id="location" placeholder="location">
					</div>
				  </div>
<!--/////////////////////////////////////////////////////////-->
				<!--   Create studentactivity Multiple Select - nice bootrsap code (link folders: doc, dist and demo)   -->
					<div class="form-group">
					<label for="students" class="col-sm-2 control-label">תלמידים</label>
					<div class="col-sm-10">
					<select class="multipleSelect" name="students_known[]" multiple name="language">
					<?php
					//$users_language = explode(",",$users["languages_known"]);
					$languages_result = mysql_query("SELECT id, name FROM student");
					$i=0;
					while($languages_stack = mysql_fetch_array($languages_result)) {
						if(in_array($users_stack["lang_name"],$users_language)) 
							$str_flag = "selected";
						else $str_flag=""; 
						?>
						<option value="<?=$languages_stack["id"];?>" <?php echo $str_flag; ?>><?=$languages_stack["name"];?></option>
						<!-- 	We want to display nickName but to send studentId  -->
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
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
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
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>	
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-10">
					  <input type="text" name="end" class="form-control" id="end" readonly>
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
		
		
		
	<!-- duble click on created event -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
			  </div>

			  <div class="modal-body">
				  <div class="form-group">
					<label for="location" class="col-sm-2 control-label">Location</label>
					<div class="col-sm-10">
					  <input type="text" name="location" class="form-control" id="location" placeholder="location">
					</div>
				  </div>	

				  <div class="form-group">
					<label for="centerid" class="col-sm-2 control-label">centerid</label>
					<div class="col-sm-10">
					  <input type="text" name="centerid" class="form-control" id="centerid" placeholder="centerid">
					</div>
				  </div>	


				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
					</div>
				  </div>
           

				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
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
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
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
			lang: initialLangCode,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			// nowIndicator: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			}, //provid the exist value when edut by click
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit #location').val(event.location);
					$('#ModalEdit #centerid').val(event.centerid);
					$('#ModalEdit').modal('show');
				});
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
					location: '<?php echo $event['location']; ?>',
					title: '<?php echo $event['title']; ?>',
					centerid: '<?php echo $event['centerid']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
					textColor: 'black', // I added this for black text color instead of white
					borderColor: 'black', // I added this for black border color instead of nothing
				},
			<?php endforeach; ?>
			]
		});

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
