<?php
/**
 * Created by Daniel Vidmar.
 * Date: 2/1/13
 * Time: 10:39 PM
 * Version: Beta 1
 * Last Modified: 3/17/2013 at 2:32 PM
 * Last Modified by Daniel Vidmar.
 */
require_once("inc/connect.php");
class USERFUNC
{
    public static function add($username, $password, $date, $lastlogin, $ip, $email, $activationKey) {
		$connect = new Connect();
        $c = $connect->connect();
		$t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("INSERT INTO $t VALUES ('', ?, ?, 1, ?, ?, ?, ?, 0, 0, 0, ?)");
		$stmt->bind_param("sssssss", $username, $password, $date, $lastlogin, $ip, $email, $activationKey);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }

    public static function delete($username) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("DELETE FROM $t WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }
	
	public function getIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) //if from shared
		{
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //if from a proxy
		{
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			return $_SERVER['REMOTE_ADDR'];
		}
	}

    public static function isAdmin($username) {
        $return = false;
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_users";
		$t2 = $connect->tablePrefix."_groups";
		$stmt = $c->prepare("SELECT `group` FROM $t WHERE username = ?");
        $stmt->bind_param("s", $username);
		$stmt->bind_result($userGroup);
		while($stmt->fetch()) {
			$query = "SELECT `isadmin` FROM $t2 WHERE user_level='$userGroup'";
			$result = $c->query($query);
			while($row = $result->fetch_assoc()) {
				if($row['group'] == '1') {
					$return = true;
				} else {
					$return = false;
				}
			}
		}
        $stmt->execute();
        $stmt->close();
		$c->close();
        return $return;
    }
	
	public static function exists($username) {
		$connect = new Connect();
        $c = $connect->connect();
		$t = $connect->tablePrefix."_users";
		$stmt = $c->prepare("SELECT username FROM $t WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->store_result();
		$num_row = $stmt->num_rows;
		$stmt->bind_result($result);
		if($num_row === 0) {
			return "false";
		} else {
			return "true";
		}
		$stmt->close();
		$c->close();
	}
	
	public static function activated($username) {
		$connect = new Connect();
        $c = $connect->connect();
		$t = $connect->tablePrefix."_users";
		$stmt = $c->prepare("SELECT activated FROM $t WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->store_result();
		$num_row = $stmt->num_rows;
		$stmt->bind_result($result);
		$stmt->fetch();
		if($result == 0) {
			return "false";
		} else {
			return "true";
		}
		$stmt->close();
		$c->close();
	}
	
	public static function validatePassword($username, $password) {
		$connect = new Connect();
		$c = $connect->connect();
		$t = $connect->tablePrefix."_users";
		$stmt = $c->prepare("SELECT password FROM $t WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->store_result();
		$num_row = $stmt->num_rows;
		$stmt->bind_result($result);
		$stmt->fetch();
		if($num_row === 0) {
			return "false1";
		} else {
			if(hash( 'sha256', $password ) === $result) {
				return "true";
			} else {
				return "false2";
			}
		}
		$stmt->close();
		$c->close();
	}
	
	public static function sendVerification($email, $activationKey) {
		$to = $email;

		$subject = "UTask Activation";

		$message = "Welcome to the tracker of Test Project!\r\rYou, or someone using your email address, has completed registration to become an Evolve Community Member. You may complete your registration by clicking the following link:\rhttp://comingsoon.com\r\rIf this is an error, ignore this email and your account will be removed. \r\rSincerely, UTask Development Team";

		$headers = 'From: utask@evolve.x10.mx' . "\r\n" . 'Reply-To: utask@evolve.x10.mx' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}

    public static function updateUser() {

    }
	
	public function generateActivationKey() {
        return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
	
	public static function login($username) {
		$connect = new Connect();
        $c = $connect->connect();
		$t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("UPDATE $t SET online = 1 WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
	}
	
	public static function logout($username) {
		$connect = new Connect();
        $c = $connect->connect();
		$t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("UPDATE $t SET online = 0 WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
	}
	
	public static function isLoggedIn($username) {
		$connect = new Connect();
        $c = $connect->connect();
		$t = $connect->tablePrefix."_users";
		$stmt = $c->prepare("SELECT online FROM $t WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->store_result();
		$num_row = $stmt->num_rows;
		$stmt->bind_result($result);
		$stmt->fetch();
		if($result == 0) {
			return "false";
		} else {
			return "true";
		}
		$stmt->close();
		$c->close();
	}

    public static function ban($username) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("UPDATE $t SET banned = 1 WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }

    public static function unban($username) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("UPDATE $t SET banned = 0 WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }
	
	public static function activate($username) {
        $connect = new Connect();
        $c = $connect->connect();
		$t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("UPDATE $t SET activated = 1 WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }
}
