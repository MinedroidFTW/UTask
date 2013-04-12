<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/28/2013
 * Time: 6:34 PM
 * Version: Beta 1
 * Last Modified: 3/28/2013 at 8:00 PM
 * Last Modified by Daniel Vidmar.
 */
require_once("inc/connect.php");

$connect = new Connect();
$c = $connect->connect();
$t = $connect->tablePrefix."_".$list;
$config = new Configuration();

$query = 'SELECT * FROM '.$t.' ORDER BY status, id';
$result = $c->query($query) or die('There was an error during the query!');

if($result->num_rows == 0) {
	echo '<p>There are currently no tasks in this list!</p>';
} else { ?>
	<table id="list">
		<thead>
			<tr>
				<th valign = "top" width="20">#</th>
				<th valign = "top" width="400">Task</th>
				<?php 
				if(!$config->getListValue($list, 'compactView')) { ?>
					<th valign = "top" width="150">Assigned To</th>
					<th valign = "top" width="150">Created</th>
					<th valign = "top" width="150">Author</th>
				<?php 
				} 
				if ($_SESSION['username'] && !$config->getListValue($list, 'rankEdit') || empty($_SESSION['username']) && $config->getListValue($list, 'guestEdit')) {
				?>
					<th valign = "top" width="200">Action</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php
				
				$query = 'SELECT id, task, info, assigned, status, date, author FROM '.$t.' ORDER BY status, id ASC';
				$result = $c->query($query) or die('There was an error during the query!');
				while($row = $result->fetch_assoc()) {
					//TODO: Print list. Will be done after I decide if I'm changing the MySQL table values or not.
				}
				
				?>
			</tr>
		</tbody>
	</table>
<?php
}
?>