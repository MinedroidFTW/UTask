<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/18/2013
 * Time: 1:59 PM
 * Version: Beta 1
 * Last Modified: 3/18/2013 at 2:07 PM
 * Last Modified by Daniel Vidmar.
 */
 session_start();
 require_once("connect.php");
 require_once("userfunc.php");
 $connect = new Connect();
 $c = $connect->connect();
 
 if(isset($_POST["user"]))
 {
	$username = $_POST["user"];
	if(User::exists($username) == "false") {
		if(isset($_POST['email'])) {
			if(isset($_POST['pass'])) {
				if(isset($_POST['conpass'])) {
					if($_POST['pass'] == $_POST['conpass']) {
						$user = $_POST["user"];
						$pass = hash( 'sha256', $_POST['pass'] );;
						$email = $_POST["email"];
						$date = date("Y-m-d");
						$ip = User::getIP();
						$activationKey = User::generateActivationKey();
						User::add($user, $pass, $date, $date, $ip, $email, $activationKey);
						User::sendVerification($email, $activationKey);
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
 ?>