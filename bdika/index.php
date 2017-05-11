<!DOCTYPE html PUBLIC >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Dynamic Drill Down in Highcharts</title>
 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<style>
body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea { font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif; }
</style>
 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="date.js"></script>
 
<script type="text/javascript">
var options;
var chart;
$(document).ready(function() {
init();
 
});
 
function init() {
$('#back_btn').hide();
options = {
chart: {
renderTo: 'container',
type: 'line'
},
title: {
text: ''
},
subtitle: {
text: ''
},
xAxis: {
categories: [],
 
labels: {
align: 'center',
x: -3,
y: 20,
formatter: function() {
return Highcharts.dateFormat('%m', Date.parse(this.value));
}
}
 
},
yAxis: {
title: {
text: ''
}
},
tooltip: {
enabled: true,
formatter: function() {
return '<b>'+ this.series.name +'</b><br/>'+
this.x +': '+ this.y;
}
},
plotOptions: {
line: {
cursor: 'pointer',
point: {
events: {
click: function() {
 
$('#dateDisplay').text(this.category);
 
$.getJSON("data.php?dateParam="+this.category, function(json){
 
options.xAxis.categories = json['category'];
options.series[0].name = json['name'];
options.series[0].data = json['data'];
 
options.xAxis.labels = {
formatter: function() {
//return Highcharts.dateFormat('%l%p', Date.parse(this.value +' UTC'));
return Highcharts.dateFormat('%Y-%m-%d', Date.parse(this.value));
//return this.value;
}
}
 
options = new Highcharts.Chart(options);
 
$('#back_btn').show();
 
});
 
 
}
}
},
dataLabels: {
enabled: true
}
}
},
 
series: [{
type: 'line',
name: '',
data: []
}]
}
 
$.getJSON("data.php", function(json){
options.xAxis.categories = json['category'];
options.series[0].name = json['name'];
options.series[0].data = json['data'];
chart = new Highcharts.Chart(options);
});
}
 
 
function goback() {
init();
$('#dateDisplay').text("2013-02");
}
 
 
</script>
 
</head>
<body>

    
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
 
<strong><div id="dateDisplay">2013-02</div></strong>
 
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
 
<a href="#" onclick="goback();" id="back_btn">Back</a>



 
</body>
</html>