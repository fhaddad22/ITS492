<?php

date_default_timezone_set('America/New_York');

$timeFormat = "g:i a";
$inputTimeFormat = "H:i"; //Use this format to get the right formatting on iPhone
$dateFormat = "m/d/Y";

$stops = array(
    1 => 'NoMa - Gallaudet',
  2 => 'Union Station',
  3 => 'MSSD',
  4 => 'KDES',
  5 => 'Benson Hall',
  6 => 'Kellogg Hotel',
  );

$routes = array(
  1 => array(
    'name' => 'Green',
      'description' => 'Regular Shuttle Bus Hours',
    'days' => array(1,2,3,4,5),
    'cssClass' => 'route-green',
    'stops' => array(
        1 => array(array(':22', ':37', ':52', ':07'), '8:36', '15:56', '16:16'),
        2 => array(array(':30', ':45', ':00', ':15'), '8:40', '16:20'),
        3 => array(array(':37', ':52', ':07', ':22'), '8:41', '16:21'),
        4 => array(array(':39', ':54', ':09', ':24'), '8:43', '16:23'),
        5 => array(array(':40', ':55', ':10', ':25'), '8:44', '16:24'),
        6 => array(array(':47', ':03', ':17', ':33'), '8:45', '16:25')

    )
  ),
    6 => array(
    'name' => 'Purple',
    'description' => 'This is a short description of Purple',
    'days' => array(1,2,3,4,5),
    'cssClass' => 'route-purple',
    'stops' => array(
      1 => array(array(':36',':56',':16'),'8:36','15:56','16:16'),
      2 => array(array(':40',':00',':20'),'8:40','16:20'),
      3 => array(array(':41',':01',':21'),'8:41','16:21'),
      4 => array(array(':43',':03',':23'),'8:43','16:23'),
      5 => array(array(':44',':04',':24'),'8:44','16:24'),
        6 => array(array(':45', ':05', ':25'), '8:45', '16:25')
    )
  ),
    3 => array(
    'name' => 'Night',
    'description' => 'This is a short description of Night',
    'days' => array(1,2,3,4),
    'cssClass' => 'route-night',
    'stops' => array(
      1 => array(array(':08',':38'),'16:38','22:08','22:38'),
        2 => array(array(':34', ':04'), '16:04', '22:34'),
        3 => array(array(':31', ':01'), '16:01', '22:31'),
      4 => array(array(':27',':57'),'16:57','22:27'),
      5 => array(array(':29',':59'),'16:59','22:29'),
        6 => array(array(':18', ':48'), '16:48', '22:18')
    )
  )
  
);



//Generate an array of all possible times for a stop
function getTimesForStop($r,$date=null)
{
  if($date == null){ $date = date('Y-m-d');}

  $temp = array();
  $startTime = strtotime($date.' '.$r[1]);
  $lt = $startTime;
  $temp[] = $startTime;
  
  $lastTime = strtotime($date.' '.$r[2]);
  if($r[3]) { $lastTime = strtotime($date.' '.$r[3]); }
  
  $h = date("H",$lt);
  
  //echo $stops[$k].' - Start departure: '.$date.' '.$r[1].'<br>';
  
  while($lt < $lastTime)
  {
    foreach($r[0] as $r2)
    {
      $temp[] = strtotime($date.' '.$h.''.$r2);
    }
    $h++;
    sort($temp);
    $lt = $temp[count($temp)-1];
  }
  $temp[] = $lastTime;
  
  if($r[3]) { $temp[] = strtotime($date.' '.$r[3]); }
  
  //echo '<pre>';
  $temp = array_unique($temp);
  foreach($temp as $k2 => $t)
  {
    if($t<$startTime or $t>$lastTime){ unset($temp[$k2]); }
    //else{ echo date("Y-m-d H:i",$t).'<br>'; }
  }
  //echo 'Last departure: '.date("Y-m-d H:i",$lastTime).'<br><br>';
  //echo '</pre>';
  sort($temp);
  return array_values($temp);
}




/* Generate JSON for the new version of the app */


$i = 1;
$routesToBeAdded = array();
foreach($routes as $r){
	echo 'var r'.$i.' = new Route({name:"'.$r['name'].'",days:['.implode(",",$r['days']).'],cssClass:"'.$r['cssClass'].'"});';
	echo "\n";
	foreach($r['stops'] as $k => $s){
		echo 'r'.$i.'.addStop({name:"'.$stops[$k].'",times:[';
		$t = getTimesForStop($s);
		$t2 = array();
		foreach($t as $d) $t2[] = '"'.date("H:i",$d).'"';
		echo implode(",", $t2);
		echo ']});';
		echo "\n";
		
	}
	echo "\n\n";
	$routesToBeAdded[] = "r".$i;
	$i++;
}

echo 'var allRoutes = new Routes(['.implode(",", $routesToBeAdded).']);';
//echo 'allRoutes.add();';

echo 'var stopNames = '.json_encode(array_values($stops)).';';



