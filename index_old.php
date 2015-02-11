<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Highcharts Example</title>


<style type="text/css">
</style>
<!-- 1. Add these JavaScript inclusions in the head of your page -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>


<!-- 2. Add the JavaScript to initialize the chart on document ready -->
<script>
var chart; // global

/**
 * Request data from the server, add it to the graph and set a timeout to request again
 */
function requestData() {
        $.ajax({
                url: 'obs_list_live_server_data.php', 
                success: function(point) {
                        var series = chart.series[0],
                                shift = series.data.length > 20; // shift if the series is longer than 20

                        // add the point
                        chart.series[0].addPoint(eval(point), true, shift);

                        // call it again after one second
                        setTimeout(requestData, 1000);	
                },
                cache: false
        });
}

$(function() {

    // If you need to specify any global settings such as colors or other settings you can do that here

    // Build Chart A
    $('#chart-A').highcharts({
    chart: {
            type: 'scatter',
            zoomType: 'xy'
            },
            title: {
                text: 'Candidator for LUT'
            },
            subtitle: {
                text: 'Date: 17/07/2014'
            },
            credits: {
                        enabled: false
            },  
            events: {
                load: requestData
            },
            xAxis: {
                title: {
                    enabled: true,
                    text: 'RA'
                },
                min: 0,
	       max: 360,
                startOnTick: true,
                endOnTick: true,
                showLastLabel: true
            },
            yAxis: {
                title: {
                    text: 'DEC'
                },
                min: 0,
	       max: 90               
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 90,
                y: 30,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                borderWidth: 1
            },
            plotOptions: {
                scatter: {
                    marker: {
                        radius: 5,
                        states: {
                            hover: {
                                enabled: true,
                                lineColor: 'rgb(100,100,100)'
                            }
                        }
                    },
                    states: {
                        hover: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>{series.id}</b><br>',
                        pointFormat: '{point.x} deg, {point.y} deg'
                    }
                }
            },
            series: [{
                name: 'Candidate',
                color: 'rgba(223, 83, 83, .5)',
                data: []

            }, {
            type: 'line',
            name: 'Average',
            data: [[30, 0], [30, 90]],
            marker: {
            	lineWidth: 2,
            	lineColor: Highcharts.getOptions().colors[3],
            	fillColor: 'white',
                  enabled: false
            }
            }]
        });

    // Build Chart B
    $('#chart-B').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Chart B'
        },
        xAxis: {
            categories: ['Jane', 'John', 'Joe', 'Jack', 'jim']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Miles during Run'
            }
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        tooltip: {
            shared: true
        },
        series: [{
            name: 'Miles',
            data: [2.4, 3.8, 6.1, 5.3, 4.1]
        }]
    });
});
</script>
<script>
     var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 6000) 
             window.location.reload(true);
         else 
             setTimeout(refresh, 1000);
     }

     setTimeout(refresh, 1000);
</script>

</head>
<body>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<?php
$my_t=getdate(gmdate("U"));
//print(" $my_t[mon] $my_t[mday] $my_t[year]");
$filedate = ("$my_t[year]_$my_t[mon]_$my_t[mday]");
//print $filedate;
?>
<table width="1160" cellpadding="0" cellspacing="0" border="0">
<tr><td height="5" bgcolor="#7CAEB1"></td></tr>
<?php
$img = "idlfile/Mini-GWAC_observing_area_map_".$filedate.".jpg";
echo "<img src=\"".$img."\"  style=\"height: 400px\" />";
?>
</td></tr>
</table> 
<div id="chart-A" style="height: 400px"></div>
<div id="chart-B" style="height: 200px"></div>
</body>
</html>
