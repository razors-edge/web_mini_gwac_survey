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
         if(new Date().getTime() - time >= 600000) 
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

<?php
//if($start_planing_form)
//{
//$my_t=getdate(gmdate("U"));
//print(" $my_t[mon] $my_t[mday] $my_t[year]");
$filedate = ("$my_t[year]_$my_t[mon]_$my_t[mday]");
$showdate = ("$my_t[year]/$my_t[mon]/$my_t[mday]");
//print $filedate;

$idl_pro = 'hour_angle_elevation_MINIGWAC_xinglong_web';
$execline = "E:/Exelis/IDL82/bin/bin.x86_64/idl -e \"".$idl_pro."\"";
exec($execline, $output);
$idl_pro1 = 'minigwac_observing_area_total_night_web';
$execline1 = "E:/Exelis/IDL82/bin/bin.x86_64/idl -e \"".$idl_pro1."\"";
exec($execline1, $output1);

$obslist = "idlfile/Mini-GWAC_observing_area_list_".$filedate.".dat";
$obstimetable = "idlfile/Mini-GWAC_observing_timelog_".$filedate.".dat";
$fp = fopen($obslist,"rb");
$ra = array();
$dec = array();
$data = array(array());
while(!feof($fp))
{
  $lines = fgets($fp,999);
  if (strlen(trim($lines)) > 0) 
  {
    $words = preg_split('/\s+/', trim($lines));
    $num_mnt = (count($words)-1)/3;
    $obs_date = $words[0];
    $obs_mode = $words[3];
  //  print_r($words);
//    echo $num_mnt;
    if ($obs_mode == 1)
      {
        for ($j=0;$j<$num_mnt;$j++)
        {			
          array_push($ra,  floatval($words[$j*3+1]));
          array_push($dec,floatval($words[$j*3+2]));
          array_push($data,array(floatval($words[$j*3+1]),floatval($words[$j*3+2])));
          }
      }
  }   
}            
fclose($fp);
$num_time_step = count($ra);
?>
<table width="1160" cellpadding="0" cellspacing="0" border="1">
<tr><td bgcolor="#7CAEB1">
<?php
$img = "idlfile/Mini-GWAC_observing_area_map_".$filedate.".jpg";
echo "<img src=\"".$img."\"  style=\"height: 400px\" />";
?>
</td>
<td bgcolor="#7CAEB1"> 
<?php
$img = "idlfile/Mini-GWAC_observing_area_list_mark_".$filedate.".jpg";
echo "<img src=\"".$img."\"  style=\"height: 400px\" />";
?>
</td></tr>
<tr><td bgcolor="#7CAEB1">
<?php
$img = "idlfile/Mini-GWAC_observing_area_list_".$filedate.".jpg";
echo "<img src=\"".$img."\"  style=\"height: 400px\" />";
?>
  </td>
  <td>
  <table cellpadding="3" cellspacing="3" border="0" " align="center">
  <tr><td height="15" bgcolor="#7CAEB1" align="center">
  Observation Time Table:  
  </td></tr>
  <tr><td height="15" bgcolor="#7CAEB1" align="center">
  <?php
  echo "<a href=\"".$obstimetable."\" target=\"_blank\"
style=color:#FF0000;text-decoration:none>   DOWNLOAD </a>";
  ?>
  </td>
  </tr>
  <tr><td height="15" bgcolor="#7CAEB1" align="center">
  Observation Plan:  
  </td></tr>
  <tr><td height="15" bgcolor="#7CAEB1" align="center">
  <?php
  echo "<a href=\"".$obslist."\" target=\"_blank\"
style=color:#FF0000;text-decoration:none>   DOWNLOAD </a>";
  ?>
  </td>
  </tr>
  </table> 

  </td></tr>
</table> 

//<?php
//}
//else
//{
//echo "<br/>";
//?>
<form name="plan_form" action="//<?php echo $PATH_INFO ?>" method="post" enctype="multipart/form-data">
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
//<?php
//}
//echo "</div>";
//?>



</body>
</html>
