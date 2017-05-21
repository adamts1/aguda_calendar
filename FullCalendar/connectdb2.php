<?php

	

if(isset($_GET['valueToSearch'])  && $_GET['valueToSearch'] !=0 && $_GET['titleToSearch']) // 0 is in case that the user choose "all options" in filter dropdown 
	{	
   


       $valueToSearch = $_GET['valueToSearch']; 
       $titleToSearch =  $_GET['titleToSearch'];
//    var_dump( $titleToSearch);
//    die;


       if($titleToSearch == '2')
       {
       
		// 1.Filter - here we get the value that user want filering
        $sql = "SELECT id, title, start, end, color, centerid, locationid, teacherid, courseid, groupNumber FROM events WHERE locationid=$valueToSearch";
		$search_result = filterTable($sql);
       }


        elseif($titleToSearch == '1')
        {
       
		 // 1.Filter - here we get the value that user want filering
        $sql = "SELECT id, title, start, end, color, centerid, locationid, teacherid, courseid, groupNumber FROM events WHERE centerid=$valueToSearch";
		$search_result = filterTable($sql);
       }

    }

	
	else{
        $sql = "SELECT id, title, start, end, color, centerid, locationid, teacherid, courseid, groupNumber FROM events";
		$search_result = filterTable($sql);
	}




?>