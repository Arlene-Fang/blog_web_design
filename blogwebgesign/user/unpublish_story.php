<?php
	include_once('include_fns.php');
	$story = $_REQUEST['story'];
	if(check_permission($_SESSION['auth_user'], $story)) {
		$con = db_connect();
		$query = "update stories set published = null where id = '$story'";
		$result = mysqli_query($con, $query);
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>