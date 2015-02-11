<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
		
		
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
				url: 'live_server_data.php', 
				success: function(point) {
					var series = chart.series[0],
						shift = series.data.length > 200; // shift if the series is longer than 20
		
					// add the point
					chart.series[0].addPoint(eval(point), true, shift);
					
					// call it again after one second
					setTimeout(requestData, 1000);	
				},
				cache: false
			});
		}
			
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					type: 'scatter',
					events: {
						load: requestData
					}
				},
				title: {
					text: 'Live random data'
				},
				xAxis: {
					type: 'datetime',
					tickPixelInterval: 150,
					maxZoom: 20 * 1000
				},
				yAxis: {
					minPadding: 0.2,
					maxPadding: 0.2,
					title: {
						text: 'Value',
						margin: 80
					}
				},
				series: [{
					name: 'Random data',
					data: []
				}]
			});
		});
                document.write(series);
		</script>
		
	</head>
	<body>
		
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
		
		<div style="width: 800px; margin: 0 auto">
			<p>This example shows how to run a live chart with data retrieved from the server
			each second. Study the source code for details.</p>
			<p>This is the content of the PHP file, <a href="live-server-data.php">
				live-server-data.php</a>:</p>
	
		</div>
	</body>
</html>