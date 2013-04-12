<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/28/2013
 * Time: 6:09 PM
 * Version: Beta 1
 * Last Modified: 3/28/2013 at 8:00 PM
 * Last Modified by Daniel Vidmar.
 */
require_once("inc/connect.php");
class LISTFUNC
{
	function create() {
	}
	
	function update($id) {
	}
	
	function transfer($id, $project) {
	}
	
	function delete($id) {
		$connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_lists";
        $stmt = $c->prepare("DELETE FROM $t WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $c->close();
	}
	
	function exists($name) {
	
	}
	
	function isMain($id) {
	}
	
	function setAccess() {
	}
	
	function hide() {
	}
	
	function show() {
	}
	
	function clean() {
	}
}

?>