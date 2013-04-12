<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/18/2013
 * Time: 1:59 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 2:07 PM
 * Last Modified by Daniel Vidmar.
 */
 require_once("userfunc.php");
 if(isset($_POST["user"]))
 {
	$username = $_POST["user"];
	if(User::exists($username) == "true") {
		echo "GTFO";
	} else {
		echo "EH";
	}
 }