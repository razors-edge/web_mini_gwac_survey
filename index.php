<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>GWAC Survey</title>


<style type="text/css">
</style>
<!-- 1. Add these JavaScript inclusions in the head of your page -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>



<script>
     var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 30000) 
             window.location.reload(true);
         else 
             setTimeout(refresh, 1000);
     }

     setTimeout(refresh, 1000);
</script>

</head>
<body>
  <?php
if(is_array($_GET)) extract($_GET);
if(is_array($_POST)) extract($_POST);
date_default_timezone_set("UTC");
$my_t=getdate(gmdate("UTC"));
//date_default_timezone_get();
$the_date = strtotime("$my_t[year]-$my_t[mon]-$my_t[mday]  $my_t[hours]:$my_t[minutes]:$my_t[seconds]");
$showdate_UTC = (date("Y-d-mTG:i:s",$the_date));

  ?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<font size="26">MINI-GWAC Survey Plan (<?php echo $showdate_UTC ?>)</font>


<form name="plan_form" action="survey_plan.php" method="post" enctype="multipart/form-data">
Start making plan:
<table width="280" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<input type="submit" name="start_planing_form" value="Submit"  />
</td><td>
</td><td>
</td></tr>

</table>	
</form>



</body>
</html>
