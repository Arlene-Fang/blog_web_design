<?php
	include_once('include_fns.php');

	$con = db_connect();

	$story = $_REQUEST['story'];
	if (check_permission($_SESSION['auth_user'], $story)){
		$query = "delete from stories where id = $story";
		$result = mysqli_query($con, $query);		
	}
	header('Location:index.php');
?>