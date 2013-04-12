/**
 * Created by Daniel Vidmar.
 * Date: 2/2/13
 * Time: 10:14 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 2:12 PM
 * Last Modified by Daniel Vidmar.
 */
$(document).ready(function(){
    $("#register").click(function(){
		$("#loginForm").fadeOut("normal");
        $("#registerForm").fadeIn("normal");
        $("#username").focus();
    });
    $("#closeRegister").click(function(){
        $("#registerForm").fadeOut("normal");
    });
	$("#login").click(function(){
		$("#registerForm").fadeOut("normal");
        $("#loginForm").fadeIn("normal");
        $("#username").focus();
    });
    $("#closeLogin").click(function(){
        $("#loginForm").fadeOut("normal");
    });
	$("#registerForm #username").change(function() {
		var username = $("#registerForm #username").val();
		
		if(username.length <= 3) {
			$("#msg").removeClass("generalMSG");
			$("#msg").removeClass("successMSG");
			$("#msg").addClass("errorMSG");
			$(".errorMSG").html("Username must be at least 4 characters long.");
		} else {
			$("#msg").removeClass("successMSG");
			$("#msg").removeClass("errorMSG");
			$("#msg").addClass("generalMSG");
			$(".generalMSG").html("Checking availability...");
			$.ajax({
            type: "POST",
            url: "inc/checkuser.php",
            data: "user="+username,
            success: function(html){
                if(html=='EH')
                {
					$("#msg").removeClass("generalMSG");
					$("#msg").removeClass("errorMSG");
					$("#msg").addClass("successMSG");
					$(".successMSG").html("Username available.");
				} else {
					$("#msg").removeClass("generalMSG");
					$("#msg").removeClass("successMSG");
					$("#msg").addClass("errorMSG");
					$(".errorMSG").html("Username is not available.");
				}
		});
	});
	$("#registerForm #confirmPassword").change(function() {
		var password = $("#registerForm #password").val();
		var confirmpassword = $("#registerForm #confirmPassword").val();
		
		if(password != confirmpassword) {
			$("#msg").removeClass("generalMSG");
			$("#msg").removeClass("successMSG");
			$("#msg").addClass("errorMSG");
			$(".errorMSG").html("Your passwords do not match.");
		} else {
			$("#msg").removeClass("generalMSG");
			$("#msg").removeClass("successMSG");
			$("#msg").removeClass("errorMSG");
			$("#msg").html(" ");
		}
	});
    $("#loginButton").click(function(){
        var username = $("#loginForm #username").val();
        var password = $("#loginForm #password").val();
        $.ajax({
            type: "POST",
            url: "inc/checklogin.php",
            data: "user="+username+"&pass="+password,
            success: function(html){
                if(html=='GTFO')
                {
					$("#msg").removeClass("generalMSG");
					$("#msg").removeClass("successMSG");
					$("#msg").addClass("errorMSG");
					$(".errorMSG").html("Wrong username or password entered!");
                } else {
                    $("#loginForm").fadeOut("normal");
                    $("h2").html("Welcome, " + username + ".<a id='logout' href='logout.php'>Log out</a>.");
                }
            }
        });
        return false;
    });
	$("#registerButton").click(function(){
        var username = $("#registerForm #username").val();
        var password = $("#registerForm #password").val();
		var confirmpassword = $("#registerForm #confirmPassword").val();
		var email = $("#registerForm #email").val();
        $.ajax({
            type: "POST",
            url: "inc/registeruser.php",
            data: "user="+username+"&pass="+password+"&conpass="confirmpassword+"&email="email,
            success: function(html){
                if(html=='GTFO')
                {
					$("#msg").removeClass("generalMSG");
					$("#msg").removeClass("successMSG");
					$("#msg").addClass("errorMSG");
					$(".errorMSG").html("Wrong username or password entered!");
                } else {
                    $("#loginForm").fadeOut("normal");
                    $("h2").html("Welcome, " + username + ".<a id='logout' href='logout.php'>Log out</a>.");
                }
            }
        });
        return false;
    });
});