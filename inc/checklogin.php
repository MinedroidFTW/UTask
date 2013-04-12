<?php
/**
 * Created by Daniel Vidmar.
 * Date: 2/1/13
 * Time: 6:11 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 6:12 PM
 * Last Modified by Daniel Vidmar.
 */
require_once("inc/connect.php");
require_once("inc/password.php");
session_start();
$username = $_POST["user"];
$password = $_POST["pass"];

$c = new Connect();
$hasher = new PasswordHasher();
$t = $c->tablePrefix;
$stmt = $c->connect()->prepare("SELECT username, password FROM ".$t."_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($result, $result1);
$num_row = $stmt->num_rows($result);
$stmt->fetch();
if($num_row != 0) {
	if($hasher->checkPassword($result1, $password) != 0) {
		$_SESSION["username"] = $result;
		echo 'ALLO';
	} else {
		echo 'INCORRECT';
	}
} else {
	echo 'NOT';
}
?>