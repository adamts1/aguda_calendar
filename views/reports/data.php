<?php
$mysqlserver="localhost";
$mysqlusername="root";
$mysqlpassword="";
$link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
$dbname = 'adam_project';
mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew





 
$sth = mysql_query("SELECT revenue FROM projections_sample");
$rows = array();
$rows['name'] = 'Revenue';
while($r = mysql_fetch_array($sth)) {
$rows['data'][] = $r['revenue'];
}
// var_dump($rows);
// die();
 
$sth = mysql_query("SELECT overhead FROM projections_sample");
$rows1 =array();
$rows1['name'] = 'Overhead';
while($rr = mysql_fetch_assoc($sth)) {
$rows1['data'][] = $rr['overhead'];
}
// var_dump($rows1);
// die();
 
$result = array();
array_push($result,$rows);
array_push ($result,$rows1);
 
print json_encode($result, JSON_NUMERIC_CHECK);
 
mysql_close($link);
?>