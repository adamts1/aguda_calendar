<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=adam_project;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

  $mysqlserver="localhost";
  $mysqlusername="root";
  $mysqlpassword="";
  $link=mysql_connect('localhost', $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());         
  $dbname = 'adam_project';
  mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
  mysql_query("SET NAMES 'utf8'",$link);

