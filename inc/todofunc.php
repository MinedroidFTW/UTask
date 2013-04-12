<?php
/**
 * Created by Daniel Vidmar.
 * Date: 1/31/13
 * Time: 12:22 AM
 * Version: Beta 1
 * Last Modified: 3/17/2013 at 2:32 PM
 * Last Modified by Daniel Vidmar.
 */
require_once("inc/connect.php");
class TODOFUNC
{
    public static function add($list, $title, $description, $assigned, $date, $due, $author) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_".$list;
        $stmt = $c->prepare("INSERT INTO $t (id, title, description, assigned, date, due_date, author, progress) VALUES ('', ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $list, $title, $description, $assigned, $date, $due, $author);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }

    public static function delete($list, $id) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_".$list;
        $stmt = $c->prepare("DELETE FROM $t WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }

    public static function update($list, $id) {
        //TODO: create this function
    }

    public static function changeStatus($list, $id, $newStatus) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_".$list;
        if($newStatus == 1) {
            $stmt = $c->prepare("UPDATE $t SET status = ?, progress = ? WHERE id = ?");
            $stmt->bind_param("iii", 1, 25, $id);
        } else if($newStatus == 2) {
            $stmt = $c->prepare("UPDATE $t SET status = ?, progress = ? WHERE id = ?");
            $stmt->bind_param("iii", 2, 100, $id);
        } else {
            $stmt = $c->prepare("UPDATE $t SET status = ? WHERE id = ?");
            $stmt->bind_param("ii", $newStatus, $id);
        }
        $stmt->execute();
        $stmt->close();
        $c->close();
    }

    public static function changeProgress($list, $id, $newProgress) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_".$list;
        $stmt = $c->prepare("UPDATE $t SET progress = ? WHERE id = ?");
        $stmt->bind_param("ii", $newProgress, $id);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }

    public static function changeID($list, $oldID, $newID) {
        $connect = new Connect();
        $c = $connect->connect();
        $t = $connect->tablePrefix."_".$list;
        $stmt = $c->prepare("UPDATE $t SET id = ? WHERE id = ?");
        $stmt->bind_param("ii", $newID, $oldID);
        $stmt->execute();
        $stmt->close();
        $c->close();
    }
}
?>
