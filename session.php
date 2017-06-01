


<?php


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
// echo $authorizationLevel;
//////////setting session into variable if exist ////////////
if (empty($_SESSION['eventsId'])) { // If there is no active session that came from getvalue.php
$eventsIdFromSession = "0";
}
else{
	$eventsIdFromSession = $_SESSION['eventsId']; // If there is active session that came from getvalue.php
}
// echo $eventsIdFromSession; // print the activityId from session



	if (empty($_SESSION['start'])) { // If there is no start time active session that came from getvalue.php
		$activityStartTimeFromSession = "2000-01-01 00:00:01";
	}
	else{
		$activityStartTimeFromSession = $_SESSION['start']; // If there is start time active session that came from getvalue.php
	}
	//echo "The start time is: ". $activityStartTimeFromSession; // print the activity start time from session

	if (empty($_SESSION['end'])) { // If there is no start time active session that came from getvalue.php
		$activityEndTimeFromSession = "2020-01-01 00:00:02";
	}
	else{
		$activityEndTimeFromSession = $_SESSION['end']; // If there is start time active session that came from getvalue.php
	}
	// echo $activityStartTimeFromSession;
	// echo $activityEndTimeFromSession;
?>