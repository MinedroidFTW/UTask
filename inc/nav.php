<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/18/2013
 * Time: 10:30 PM
 * Version: Beta 1
 * Last Modified: 3/19/2013 at 6:10 PM
 * Last Modified by Daniel Vidmar.
 */
require_once 'user.php';
$user = new USER();
if($page == 'admin') { ?>
<div id='nav'>
	<ul>
		<li><a href='#'><span>Overview</span></a></li>
		<li><a href='#'><span>Lists</span></a></li>
		<li><a href='#'><span>Admin<span></a>
			<ul>
				<li><a href='#'><span>Config</span></a></li>
				<li><a href='#'><span>Groups</span></a></li>
				<li><a href='#'><span>Lists</span></a></li>
				<li><a href='#'><span>Projects</span></a></li>
				<li><a href='#'><span>Users</span></a></li>
			</ul>
		</li>
		<li><a href='#'><span>Dashboard</span></a></li>
	<ul>
</div>
<?php } else { ?>
<div id='nav'>
	<ul>
		<li><a href='#'><span>Overview</span></a></li>
		<li><a href='#'><span>Lists</span></a></li>
		<?php 
		if(isset($_SESSION['username'])) { 
			if($user->isAdmin($_SESSION['username'])) {
		?>
				<li><a href='#'><span>Admin<span></a>
					<ul>
						<li><a href='#'><span>Config</span></a></li>
						<li><a href='#'><span>Groups</span></a></li>
						<li><a href='#'><span>Lists</span></a></li>
						<li><a href='#'><span>Projects</span></a></li>
						<li><a href='#'><span>Users</span></a></li>
					</ul>
				</li>
			<?php } ?>
			<li><a href='#'><span>Dashboard</span></a></li>
		<?php
		}
		?>
	<ul>
</div>
<?php } ?>