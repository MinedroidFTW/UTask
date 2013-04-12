<?php
/**
 * Created by Daniel Vidmar.
 * Date: 2/1/13
 * Time: 4:33 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 7:35 PM
 * Last Modified by Daniel Vidmar.
 */
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Tracker|Demo</title>
    <link rel="stylesheet" type="text/css" href="#" />
    <link rel="stylesheet" href="themes/default/jquery-ui-1.9.1.custom.min.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.1.custom.min.js"></script>
    <script type="text/javascript" src="js/apng-canvas.min.js"></script>
	<script type="text/javascript" src="js/UTask.js"></script>
    <script type="text/javascript">
        function Message(msg){
            if ($("body div.msgBG div.msg").length > 0) { setTimeout(function(){Message(msg);}, 5000); return; }
            $("body").append('<div class="msgBG" style="z-index:100;position:absolute;top:50%;left:50%;width:450px;background-image:url(pixel.png);border-radius:10px;display:none;"></div>');
            $("div.msgBG:last").append('<div class="msg" style="font-size:12pt;font-family:\'Trebuchet MS\';padding:15px;margin:10px;background-color:white;color:black;">' + msg + '</div>');
            $("div.msgBG:last").css("margin-top", -($("div.msgBG:last").outerHeight() / 2))
                .css("margin-left", -($("div.msgBG:last").outerWidth() / 2));
            setTimeout(function(){$("body div.msgBG").fadeIn(500);}, 100);
            setTimeout(function(){$("body div.msgBG").fadeOut(500, function(){$(this).remove();});}, 4000);
        }
        $(function(){
            $('table#list td.task a').click(function(){
                if ($(this).parent().parent().find("td.id img").length > 0) return false;
                $(this).parent().parent().find("td.id").append('<img src="css/images/loading.png" style="float:right" alt="Loading..."/>');
                setTimeout(function(){APNG.ifNeeded(function(){ APNG.animateImage($("td.id img")[0]); });},100);
                $.post($(this).attr('href'), function(d){
                    $("div.2").html(d).slideDown(1000);
                    $("div.1").slideUp(1000, function(){ $("div.1 td.id img").remove(); }).find("h2").css("display","none");
                    $("div.2 .back").click(function(){
                        $("div.1").slideDown(1000).find("h2").css("display","block");
                        $("div.2").slideUp(1000, function(){$("div.2").html("");}).find("h2").css("display","none");
                        return false;
                    });
                }).fail(function(){
                        Message("Could not get information, please check your internet connection or try again.");
                        $("div.1 td.id img").remove();
                    });
                return false;
            });
        });
        $(function() {
            $( "#due" ).datepicker({
                dateFormat: "yy-mm-dd",
                showOn: "button",
                buttonImage: "inc/css/images/calendar.png",
                buttonImageOnly: true
            });
        });
        $(document).bind("contextmenu", function(e) {
            return false;
        });
    </script>
</head>
<body>
<div class="1">
    <?php include 'inc/nav.php'; ?>
    <h1>Tracker for DemoProject</h1>
    <div id='main'>
	<?php
	if(isset($msg)) { echo $msg; }
    if(isset($_SESSION["username"]) && $banned == 0) {
        echo "<h2>Welcome, ".$_SESSION['username'].". <a id='logout' href='logout.php'>Log out</a>.</h2>";
    } else if(isset($_SESSION["username"]) && $banned > 0) {
        echo "<h2>I'm sorry, but you're currently banned.</h2>";
    } else if(empty($_SESSION["username"])) {
        echo "<h2>Welcome Guest! Please consider <a id='login' href='#'>logging in</a>.</h2>";
    }
    ?>
    </div>
    <div id="registerForm">
		<h4>Register</h4>
		<div id="msg"></div>
		<form action="#">
			<label for="username">Username:</label>
			<input type="text" id="username" placeholder="Username" /><br>
			<label for="password">Password:</label>
			<input type="password" id="password" placeholder="Password" style="margin-left: 5px;"/><br>
			<label for="password">Confirm:</label>
			<input type="password" id="confirmPassword" placeholder="Confirm Password" style="margin-left: 16px;"/><br>
			<label for="password">Email:</label>
			<input type="text" id="email" placeholder="Email" style="margin-left: 35px;"/><br>
			<input type="submit" id="registerButton" class="trackrButton" value="Register" style="margin-left: 33%;"/>
			<input type="button" id="closeRegister" class="trackrButton" value="Cancel" />
		</form>
	</div>
	<div id="loginForm">
		<h4>Login</h4>
		<div id="msg"></div>
		<form action="#">
			<label for="username">Username:</label>
			<input type="text" id="username" placeholder="Username" /><br>
			<label for="password">Password:</label>
			<input type="password" id="password" placeholder="Password" style="margin-left: 5px;"/><br>
			<input type="submit" id="loginButton" class="trackrButton" value="Login" style="margin-left: 33%;"/>
			<input type="button" id="closeLogin" class="trackrButton" value="Cancel" />
		</form>
	</div>
</div>
<div class="2">
</div>
</body>
</html>