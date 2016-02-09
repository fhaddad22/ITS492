<?php

date_default_timezone_set('America/New_York');

$timeFormat = "g:i a";
$inputTimeFormat = "H:i"; //Use this format to get the right formatting on iPhone
$dateFormat = "m/d/Y";

$stops = array(
  1 => 'NoMa - Gallaudet', //Combined
  2 => 'Union Station',
  3 => 'MSSD',
  4 => 'KDES',
  5 => 'Benson Hall',
  6 => 'Kellogg Hotel',
  );

$routes = array(
  1 => array(
    'name' => 'Red',
    'description' => 'This is a short description of Red',
    'days' => array(1,2,3,4,5),
    'cssClass' => 'route-red',
    'stops' => array(
      1 => array(array(':21',':36',':51',':06'),'7:36','16:06','16:21'),
      12 => array(array(':23',':38',':53',':08'),'7:38','16:08'),
      13 => array(array(':24',':39',':54',':09'),'7:39','16:09'),
      9 => array(array(':25',':40',':55',':10'),'7:40','16:10'),
      8 => array(array(':26',':41',':56',':11'),'7:41','16:11'),
      7 => array(array(':28',':43',':58',':13'),'7:43','16:13'),
      18 => array(array(':31',':46',':01',':16'),'7:46','16:16'),
      19 => array(array(':32',':47',':02',':17'),'7:47','16:17'),
      20 => array(array(':34',':49',':04',':19'),'7:49','16:19'),
      21 => array(array(':35',':50',':05',':20'),'7:50','16:20')
    )
  ),
  2 => array(
    'name' => 'Blue',
    'description' => 'This is a short description of Blue',
    'days' => array(1,2,3,4,5),
    'cssClass' => 'route-blue',
    'stops' => array(
      1 => array(array(':31',':46',':01',':16'),'7:31','16:58','16:31'),
      21 => array(array(':32',':47',':02',':17'),'7:32','16:59'),
      20 => array(array(':33',':48',':03',':18'),'7:33','16:00'),
      22 => array(array(':34',':49',':04',':19'),'7:34','16:01'),
      19 => array(array(':35',':50',':05',':20'),'7:35','16:02'),
      18 => array(array(':36',':51',':06',':21'),'7:36','16:03'),
      7 => array(array(':40',':55',':10',':25'),'7:40','16:07'),
      8 => array(array(':41',':56',':11',':26'),'7:41','16:08'),
      9 => array(array(':42',':57',':12',':27'),'7:42','16:09'),
      13 => array(array(':43',':58',':13',':28'),'7:43','16:10'),
      11 => array(array(':44',':59',':14',':29'),'7:44','16:11')
    )
  ),
  3 => array(
    'name' => 'Green',
    'description' => 'This is a short description of Green',
    'days' => array(1,2,3,4,5),
    'cssClass' => 'route-green',
    'stops' => array(
      2 => array(array(':25',':45',':05'),'7:25','15:45'),
      1 => array(array(':29',':49',':09'),'7:29','15:29','15:29'),
      12 => array(array(':30',':50',':10'),'7:30','15:30'),
      13 => array(array(':31',':51',':11'),'7:31','15:31'),
      9 => array(array(':32',':52',':12'),'7:32','15:32'),
      8 => array(array(':33',':53',':13'),'7:33','15:33'),
      7 => array(array(':35',':55',':15'),'7:35','15:35'),
      6 => array(array(':37',':57',':17'),'7:37','15:37'),
      5 => array(array(':38',':58',':18'),'7:38','15:38'),
      4 => array(array(':40',':00',':20'),'7:40','15:40'),
      3 => array(array(':41',':01',':21'),'7:41','15:41')
    )
  ),
  4 => array(
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
      6 => array(array(':45',':05',':25'),'8:45','16:25'),
      7 => array(array(':48',':08',':28'),'8:48','16:28'),
      8 => array(array(':49',':09',':29'),'8:49','16:29'),
      9 => array(array(':51',':11',':31'),'8:51','16:31'),
      13 => array(array(':52',':12',':32'),'8:52','16:32'),
      11 => array(array(':53',':13',':33'),'8:52','16:33')
    )
  ),
  5 => array(
    'name' => 'Night',
    'description' => 'This is a short description of Night',
    'days' => array(1,2,3,4),
    'cssClass' => 'route-night',
    'stops' => array(
      1 => array(array(':08',':38'),'16:38','22:08','22:38'),
      21 => array(array(':09',':39'),'16:39','22:09'),
      20 => array(array(':10',':40'),'16:40','22:10'),
      22 => array(array(':11',':41'),'16:41','22:11'),
      19 => array(array(':12',':42'),'16:42','22:12'),
      18 => array(array(':14',':44'),'16:44','22:14'),
      7 => array(array(':18',':48'),'16:48','22:18'),
      8 => array(array(':19',':49'),'16:49','22:19'),
      9 => array(array(':21',':51'),'16:51','22:21'),
      13 => array(array(':22',':52'),'16:52','22:22'),
      11 => array(array(':23',':53'),'16:53','22:23'),
      23 => array(array(':24',':54'),'16:54','22:24'),
      4 => array(array(':27',':57'),'16:57','22:27'),
      5 => array(array(':29',':59'),'16:59','22:29'),
      3 => array(array(':31',':01'),'16:01','22:31'),
      2 => array(array(':34',':04'),'16:04','22:34')
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



