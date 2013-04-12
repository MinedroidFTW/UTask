<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/17/2013
 * Time: 1:25 AM
 * Version: Beta 1
 * Last Modified: 3/28/2013 at 6:09 PM
 * Last Modified by Daniel Vidmar.
 */
session_start();
if(isset($_GET['lang'])) {
	$language = $_GET['language'];
	$_SESSION['language'] = $language;
	setcookie('language', $language, time() + (3600 * 24 * 30));
} else if(isset($_SESSION['language'])) {
	$language = $_SESSION['language'];
} else if(isset($_COOKIE['language'])) {
	$language = $_COOKIE['language'];
} else {
	$language = 'en';
}

/**
 * The projects feature will not be in Beta 1. 
 *
if(isset($_GET['p'])) {
	$project = $_GET['p'];
	$_SESSION['p'] = $l;
	setcookie('p', $project, time() + (3600 * 24 * 30));
} else if(isset($_SESSION['p'])) {
	$project = $_SESSION['p'];
} else if(isset($_COOKIE['p'])) {
	$project = $_COOKIE['p'];
} else {
	//TODO: Once new configuration system is done this needs to get main project.
}*/

if(isset($_GET['l'])) {
	$list = $_GET['l'];
	$_SESSION['l'] = $list;
	setcookie('l', $list, time() + (3600 * 24 * 30));
} else if(isset($_SESSION['l'])) {
	$list = $_SESSION['l'];
} else if(isset($_COOKIE['l'])) {
	$list = $_COOKIE['l'];
} else {
	//TODO: Once new configuration system is done this needs to get main list.
}

include_once('');

?>