
	
     <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
  <!--<script src='js/lang-all.js'></script> 	-->
	<script src='js/he.js'></script>

    
    
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



			defaultView: 'agendaWeek', // Default view is now agendaWeek instead of month. we can allso use agendaDay

			lang: initialLangCode,
			hiddenDays:[6],

      
      navLinks: true, // we can click day/week (only if weekNumbers is true) numbers to navigate to spesific view 
			// isRTL: true,
			//businessHours: true, // display business hours // If we want gray background color for sunday and saturday 
			eventLimit: true, // allow "more" link when too many events
			weekends: false, // If we don't eant to display Saturday and Sunday
			hiddenDays: [6], // hide Saturday
			//fixedWeekCount: true, // False if we want 4.5 - 6 rows of calendar instead of default 6
			// weekNumbers: true, // If we want to display week numbers 
			scrollTime: '07:30:00', // The day start at 6:30 instead of 6:00
			minTime: "07:00:00", // Min Time of every day
			maxTime: "18:00:00", // Max time of every day
			displayEventTime : false, // If we want to hide the display of time in every event
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

          // element.find('.fc-title').append("<br/><b>מורה בפעילות: </b>" + event.teacherid + "</br>"); // We can change event.comment to what we want disply
          // element.find('.fc-title').append("<br/><b>מקצועת: </b>" + event.courseid + "</br>"); // We can change event.comment to what we want disply
          element.find('.fc-title').append("<br/><b>תלמידים: </b>" + event.studentstring + "</br>"); // We can change event.comment to what we want disply
          // element.find('.fc-title').append("<br/><b>מיקום: </b>" + event.locationid + "</br>"); // We can change event.comment to what we want disply

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

