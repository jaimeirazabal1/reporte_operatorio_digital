<?php error_reporting(0); ?>
<?php
/// TIME
date_default_timezone_set('GMT');
$TIME = date("d-m-Y H:i:s"); 

/// COUNTRY
$IPPPPP = getenv("REMOTE_ADDR");
$COUNTRYaaa = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=$IPPPPP");
$COUNTRY = $COUNTRYaaa->geoplugin_countryName ; // Country

/// VISITOR
$ip = getenv("REMOTE_ADDR");
$file = fopen("Visit.txt","a");
fwrite($file," user-agent : ".$_SERVER['HTTP_USER_AGENT']."\n ip : ".$ip."  -   ".$TIME."                  -        " . $COUNTRY ."\n")  ;
?>