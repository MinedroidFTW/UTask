<?php
/**
 * Created by Daniel Vidmar.
 * Date: 2/15/13
 * Time: 1:06 PM
 * Version: Beta 1
 * Last Modified: 3/17/2013 at 2:32 PM
 * Last Modified by Daniel Vidmar.
 */
require_once("inc/connect.php");
$connect = new Connect();
$c = $connect->connect();
if(isset($_GET['id'])) {
	$taskID = $_GET['id'];
} else {
	$taskID = 0;
}


?>