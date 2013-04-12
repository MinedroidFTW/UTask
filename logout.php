<?php
/**
 * Created by Daniel Vidmar.
 * Date: 2/1/13
 * Time: 6:10 PM
 * Version: Beta 1
 * Last Modified: 3/17/2013 at 2:32 PM
 * Last Modified by Daniel Vidmar.
 */
session_start();
unset($_SESSION['username']);
header('Location: index.php');
?>