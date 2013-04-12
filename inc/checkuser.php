<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/18/2013
 * Time: 1:59 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 2:07 PM
 * Last Modified by Daniel Vidmar.
 */
 require_once("inc/connect.php");
 $c = new Connect();
 $t = $c->tablePrefix."_users";
 if(isset($_POST["user"]))
 {
	$username = $_POST["user"];
	$stmt = $c->connect()->prepare("SELECT username FROM $t WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->bind_result($result);
	$num_row = $stmt->num_rows($result);
	$stmt->fetch();
	if($num_row != 0) {
		echo "GTFO";
	} else {
		echo "EH";
	}
 }