<?php
/* @var $this yii\web\View */
?>

<p>
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script> Highcharts.chart('container', {
    chart: {
        type: 'column'
    },

    title: {
        text: 'ריכוז שעות לפי מורה'
    },
    subtitle: {
        text: 'ריכוז שעות מורה לפי מורה'
    },
    xAxis: {
       categories: [],
    },
    yAxis: {
        title: {
            text: 'מספר שעות'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    

    series: [{
        name: 'תקופה',
        colorByPoint: true,
        data: [{
            name: '01/01/17-07/01/17',
            y: 25,
            drilldown: 'Microsoft Internet Explorer'
        }, {
            name: 'd',
            y: 24.03,
            drilldown: 'Chrome'
        }, {
            name: 'Firefox',
            y: 10.38,
            drilldown: 'Firefox'
        }, {
            name: 'Safari',
            y: 4.77,
            drilldown: 'Safari'
        }, {
            name: 'Opera',
            y: 0.91,
            drilldown: 'Opera'
        }, {
            name: 'Proprietary or Undetectable',
            y: 0.2,
            drilldown: null
    }, {
            name: '111 or Undetectable',
            y: 5.2,
            drilldown: null
    }

        
        
        ]
    }],
    drilldown: {
        series: [{
            name: 'Microsoft Internet Explorer',
            id: 'Microsoft Internet Explorer',
            data: [
                [
                    'ראשון',
                    24.13
                ],
                [
                    'שני',
                    17.2
                ],
                [
                    'שלישי',
                    8.11
                ],
                [
                    'רביעי',
                    5.33
                ],
                [
                    'חמישי',
                    1.06
                ],
                [
                    'שישי',
                    1.06
                ],
                
            ]
        }, {
            name: 'Chrome',
            id: 'Chrome',
            data: [
                [
                    'v40.0',
                    5
                ],
                [
                    'v41.0',
                    4.32
                ],
                [
                    'v42.0',
                    3.68
                ],
                [
                    'v39.0',
                    2.96
                ],
                [
                    'v36.0',
                    2.53
                ],
                [
                    'v43.0',
                    1.45
                ],
                [
                    'v31.0',
                    1.24
                ],
                [
                    'v35.0',
                    0.85
                ],
                [
                    'v38.0',
                    0.6
                ],
                [
                    'v32.0',
                    0.55
                ],
                [
                    'v37.0',
                    0.38
                ],
                [
                    'v33.0',
                    0.19
                ],
                [
                    'v34.0',
                    0.14
                ],
                [
                    'v30.0',
                    0.14
                ]
            ]
        }, {
            name: 'Firefox',
            id: 'Firefox',
            data: [
                [
                    'v35',
                    2.76
                ],
                [
                    'v36',
                    2.32
                ],
                [
                    'v37',
                    2.31
                ],
                [
                    'v34',
                    1.27
                ],
                [
                    'v38',
                    1.02
                ],
                [
                    'v31',
                    0.33
                ],
                [
                    'v33',
                    0.22
                ],
                [
                    'v32',
                    0.15
                ]
            ]
        }, {
            name: 'Safari',
            id: 'Safari',
            data: [
                [
                    'v8.0',
                    2.56
                ],
                [
                    'v7.1',
                    0.77
                ],
                [
                    'v5.1',
                    0.42
                ],
                [
                    'v5.0',
                    0.3
                ],
                [
                    'v6.1',
                    0.29
                ],
                [
                    'v7.0',
                    0.26
                ],
                [
                    'v6.2',
                    0.17
                ]
            ]
        }, {
            name: 'Opera',
            id: 'Opera',
            data: [
                [
                    'v12.x',
                    0.34
                ],
                [
                    'v28',
                    0.24
                ],
                [
                    'v27',
                    0.17
                ],
                [
                    'v29',
                    0.16
                ]
            ]
        }]
    }
});



</script>
</p>
