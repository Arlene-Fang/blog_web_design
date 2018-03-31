<?php
	session_start();
	include_once('db.php');
	unset($_SERVER['auth_user']);
	session_destroy();
	echo "<script type='text/javascript'>window.history.back(-1);</script>";
?>