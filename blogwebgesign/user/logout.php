<?php
	include_once('include_fns.php');
	unset($_SERVER['auth_user']);
	session_destroy();
	header('Location:index.php');
?>