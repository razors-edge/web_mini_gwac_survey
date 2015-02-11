<?php
// Set the JSON header
header("Content-type: text/json");

$idl_pro = 'Hour_angle_elevation_MINIGWAC_xinglong_web';
$execline = "E:/Exelis/IDL82/bin/bin.x86_64/idl -e \"".$idl_pro."\"";
exec($execline, $output);
$idl_pro1 = 'minigwac_observing_area_total_night_web';
$execline1 = "E:/Exelis/IDL82/bin/bin.x86_64/idl -e \"".$idl_pro1."\"";
exec($execline1, $output1);

$my_t=getdate(gmdate("U"));
//print(" $my_t[mon] $my_t[mday] $my_t[year]");
$filedate = ("$my_t[year]_$my_t[mon]_$my_t[mday]");
//print $filedate;

$obslist = "idlfile/Mini-GWAC_observing_area_list_".$filedate.".dat";
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
array_shift($data);
echo json_encode($data);
?>

