<?php 
session_start();
if(isset($_POST['eventsID'])) // if get session from index ajax
    {
        $_SESSION["eventsId"] = $_POST['eventsID']; // activityId to session
    }

if(isset($_POST['start'])) // if got start time session from index ajax
    {
        $_SESSION["start"] = $_POST['start']; // start time to session
    }

if(isset($_POST['end'])) // if got end time session from index ajax
    {
        $_SESSION["end"] = $_POST['end']; // end time to session
    }

?>