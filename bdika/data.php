<?php
$mysqlserver="localhost";
$mysqlusername="root";
$mysqlpassword="";
$link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
$dbname = 'adam_project';
mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew


 
if (isset($_GET["dateParam"])) {

$sql = mysql_query(
"SELECT   start, TIMESTAMPDIFF(MINUTE , start ,end)/60 as hours, teacherid  FROM events
 JOIN teacher ON events.teacherid =teacher.id
 JOIN user ON teacher.id = user.id
 WHERE teacherid = '40' AND start LIKE '".$_GET["dateParam"]."%'");
   

} 
else {
$sql =mysql_query(
"SELECT DATE_FORMAT(start, '%Y-%m') as start, SUM(TIMESTAMPDIFF(MINUTE , start ,end)/60) as hours, teacherid   FROM events
 JOIN teacher ON events.teacherid =teacher.id
 JOIN user ON teacher.id = user.id
 WHERE start LIKE '2017-%' 
 AND teacherid = '40'
 GROUP BY DATE_FORMAT(start, '%m')");}

$result['name'] = 'Foot Traffic Count';
while($r = mysql_fetch_array($sql)) {
$datetime = $r['start'];
//   var_dump($datetime);
 
$result['category'][] = $datetime;
$result['data'][] = $r['hours'];
}

// die();
 
print json_encode($result, JSON_NUMERIC_CHECK); 
mysql_close($link);
?>