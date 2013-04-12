<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/18/2013
 * Time: 1:59 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 2:07 PM
 * Last Modified by Daniel Vidmar.
 */
 require_once("connect.php");
 require_once("userfunc.php");
 require_once("password.php");
 $c = new Connect();
 $user = new USERFUNC();
 $hasher = new PasswordHasher();
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
		if(isset($_POST['email'])) {
			if(isset($_POST['pass'])) {
				if(isset($_POST['conpass'])) {
					if($_POST['pass'] == $_POST['conpass']) {
						$user = $_POST["user"];
						$pass = $hasher->hashPass($_POST["pass"]);
						$email = $_POST["email"];
						$date = date("Y-m-d");
						$ip = $user->getIP();
						$user->add($user, $pass, $date, $ip, $email);
						echo 'ALLO';
					} else {
						echo '!PASS';
					}
				} else {
					echo 'NOCON';
				}
			} else {
				echo 'NOPASS';
			}
		} else {
			echo 'NOMAIL';
		}
	} else {
		echo "GTFO";
	}
 } else {
	echo 'NOUSER';
 }