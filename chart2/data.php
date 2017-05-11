<?php
$mysqlserver="localhost";
$mysqlusername="root";
$mysqlpassword="";
$link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
$dbname = 'adam_project';
mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
mysql_query("SET NAMES 'utf8'",$link); // Generate utf8 for hebrew

if (($_GET["dateParam"])) {
$sql = mysql_query(
"SELECT  TIMEDIFF(end ,start) as hours , start FROM events WHERE start  LIKE '".$_GET["dateParam"]."%'");
} else {    
$sql =mysql_query(
"SELECT DATE_FORMAT(start, '%Y-%m-%d') as start, SUM(TIMEDIFF(end ,start)) as hours, teacherid FROM events
 JOIN teacher ON events.teacherid =teacher.id
JOIN user ON teacher.id = user.id
WHERE start LIKE '2017-%' 
AND teacherid = '36'
GROUP BY DATE_FORMAT(start, '%Y-%m-%d')");
}
$result['name'] = 'Foot Traffic Count';
while($r = mysql_fetch_array($sql)) {
$datetime = $r['timestamp_value'];
$result['category'][] = $datetime;
$result['data'][] = $r['hours'];
}
 
print json_encode($result, JSON_NUMERIC_CHECK);
 
mysql_close($link);
?>
 


