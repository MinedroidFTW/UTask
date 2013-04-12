<?php
/**
 * Created by Daniel Vidmar.
 * Date: 2/1/13
 * Time: 6:11 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 6:12 PM
 * Last Modified by Daniel Vidmar.
 */
session_start();
require_once("userfunc.php");
if(isset($_POST["user"]) && isset($_POST['pass']))
 {
	$username = $_POST["user"];
	$password = $_POST["pass"];
	if(User::validatePassword($username, $password) == "true") {
		if(User::activated($username) == "true") {
			User::login($username);
			$_SESSION['username'] = $username;
			$_SESSION['last_active'] = time();
			echo "ALLO";
		} else {
			echo "ACT";
		}
	} else {
		echo "GTFO";
	}
} else {
	echo "GTFO";
}
?>