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
    public static function add($username, $password, $date, $ip, $email) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("INSERT INTO $t (id, username, password, group, date, lastlogin, ip, email, banned) VALUES ('', ?, ?, '', ?, '', ?, ?, '')");
		$stmt->bind_param("sssss", $username, $password, $date, $ip, $email);
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

    public static function ban($username) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("UPDATE $t SET banned = ? WHERE username = ?");
        $stmt->bind_param("is", 1, $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }

    public static function unban($username) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_users";
        $stmt = $c->prepare("UPDATE $t SET banned = ? WHERE username = ?");
        $stmt->bind_param("is", 0, $username);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }
}
