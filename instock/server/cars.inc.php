<?
	$glArray=array();
    $glArray["Ford"][]="Escape";
    $glArray["Ford"][]="Expedition";
    $glArray["Ford"][]="Explorer";
    $glArray["Ford"][]="Focus";
    $glArray["Ford"][]="Mustang";
    $glArray["Ford"][]="Thunderbird";

    $glArray["Honda"][]="Accord";
    $glArray["Honda"][]="Civic";
    $glArray["Honda"][]="Element";
    $glArray["Honda"][]="Ridgeline";

    $glArray["Mazda"][]="Mazda 3";
    $glArray["Mazda"][]="Mazda 6";
    $glArray["Mazda"][]="RX-8";
   
  function cxmlByName($name){
  	global $glArray;
  	foreach($glArray as $k => $v){
  		foreach($v as $k2 => $v2){
  		//cho $k.'='.$v.' ';
  		if (strpos('_'.$v2,$name)>0)
  			echo '<item><name>'.$v2.'</name><value>'.$k.'</value></item>';
  		}
  	}
  }
  function cxmlByMake($make){
  	global $glArray;
  	$v=$glArray[$make];
  		foreach($v as $k2 => $v2){
  			echo '<item><name>'.$v2.'</name><value>'.$make.'</value></item>';
  		}
  }
  
  function chtmlByMake($make){
  	global $glArray;
	$make=trim($make);
	$ml=$glArray[$make];
	echo 'make:'.$make.':';
	echo 'ml:'.$ml;

    $html = '';
    $html.="<h2>".strToUpper($make).'</h2><p>Models</p><ul>';
    foreach ($ml as $k => $v){
     $html.="<li>".$v."</li>";
    }
    $html.="</ul><br><code>Last Updated:";
?>
<?=$html?><b><?=Date('Y-m-d H:i:s')?></b></code>
<?
  }

?>