<?php
	include_once('include_fns.php');
	if(!isset($_REQUEST['username']) || (!isset($_REQUEST['password']))) {
		echo 'You must enter your username and password to proceed';
		exit;
	}
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	if (login($username, $password)) {
		$_SESSION['auth_user'] = $username;
		echo "<script type='text/javascript'>location.href='index.php';</script>";
	}else{
		echo "<script type='text/javascript'>alert('Username/password is incorrect.');window.history.back(-1);</script>";
		exit;
	}
?>