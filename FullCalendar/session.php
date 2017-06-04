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

?>