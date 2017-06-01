<?php

include "session.php";   




if(isset($_GET['valueToSearch']) && $_GET['titleToSearch'] && $_GET['valueToSearch'] !=0 && $_GET['titleToSearch'] !=0) // 0 is in case that the user choose "all options" in filter dropdown 
	{	 // In case the user selected proper filtering
   


       $valueToSearch = $_GET['valueToSearch']; 
       $titleToSearch =  $_GET['titleToSearch'];
//    var_dump( $titleToSearch);
//    die;


       if($titleToSearch == '2')
       {
       
		// 1.Filter - here we get the value that user want filering
        $sql = "SELECT id, title, start, end, color, centerid, locationid, teacherid, courseid, groupNumber, studentstring FROM events WHERE locationid=$valueToSearch";
		$firstFilterValue = "מיקום";
		$sqlValueToSearch = "SELECT `name` FROM `location` WHERE `id`=$valueToSearch";
       }


        elseif($titleToSearch == '1')
        {
       
		 // 1.Filter - here we get the value that user want filering
        $sql = "SELECT id, title, start, end, color, centerid, locationid, teacherid, courseid, groupNumber, studentstring FROM events WHERE centerid=$valueToSearch";
		$firstFilterValue = "מרכז";
		$sqlValueToSearch = "SELECT `name` FROM `center` WHERE `id`=$valueToSearch";
       }

    }

	
	else{
        $sql = "SELECT E.id, E.title, E.start, E.end, E.color, E.centerid, E.locationid, E.teacherid, E.courseid, E.groupNumber, E.studentstring FROM events E
                JOIN center AS C  ON E.centerid =C.id 
                JOIN supervisor AS S ON C.id =S.centerId
                WHERE  S.id = '$identity'";
        $firstFilterValue = "חיפוש לפי";
		$sqlValueToSearch = "0";	}




?>