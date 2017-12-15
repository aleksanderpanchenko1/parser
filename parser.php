<?php
ini_set('user_agent','Chrome');

$url = 'http://www.investing.com/indices/uk-100/';
$file = file_get_contents($url);

$pattern = '#<span class="arial_26 inlineblock pid-27-last" id="last_last".+?</span>#';
$pattern1 = '#<span class="lighterGrayFont noBold">Open:</span> <span dir="ltr".+?</span>#';


preg_match($pattern, $file, $ftse);
preg_match($pattern1, $file, $open);

foreach ($ftse as $fts) {}

foreach ($open as $opn) {}


$fts = strip_tags($fts);
$opn = strip_tags($opn);


$fts = preg_replace('/[^.0-9]/', '', $fts);
$opn= preg_replace('/[^.0-9]/', '', $opn);


$float_open = floatval($opn);
$float_fts = floatval($fts);

$float_open1 = $float_open -1;

$percent = ($float_fts / $float_open1) * 100;

echo $percent;
echo "<hr><br>";
echo "FTSE:".$float_fts;
echo "<br>";
echo "Open:".$float_open1;
echo "<br><hr>";

function insertinfo($float_fts,$float_open,$percent) {
$serverName = "localhost";
    $database = "shop";
    $uid = 'root';
    $pwd = '';

$link="sqlsrv:server=$serverName;Database=$database";


	$db = new PDO($link, 'root',''); 
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $sql="INSERT INTO tb_name ('fts','open','percent') VALUES ($float_fts,$float_open,$percent)";

	$st=$db->prepare($sql);
	if($st->execute()!=true){
				return false;
			} else {

				$st=null;						
				return true;
			}	
	
}
insertinfo($float_fts,$float_open,$percent);




?>