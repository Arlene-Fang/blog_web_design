<?php
function db_connect(){
	try {
		$con = mysqli_connect("localhost","username","password","database");
		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}
	} catch (Exception $e) {
		echo $e -> message;
		exit;
	}
	if (!$con) {
		return false;
	}
	return $con;
}

function get_writer_record($username) {
  	$con = db_connect();
  	$query = "select * from writers where username = '$username'";
  	$result = mysqli_query($con, $query);
  	return mysqli_fetch_assoc($result);
}  

function get_story_record($story) {
	$con = db_connect();
	$query = "select * from stories where id = '$story'";
	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);
}

function get_story_category($post_category) {
	$con = db_connect();
	$query = "select * from stories where id = '$post_category'";
	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);
}

function query_select($name, $query, $default='') {
	$con = db_connect();
	$result = mysqli_query($con, $query);
	if (!$result) {
		return('');
	}

	$select = "<select name = '$name' required>";
	$select .= "<option value = '' disabled selected>-- Choose --</option>";

	for ($i=0; $i < mysqli_num_rows($result) ; $i++) {
		$option = mysqli_fetch_array($result);
		$select .= "<option value='{$option[0]}'>[{$option[0]}] {$option[1]}</option>";
	}
	$select .= "</select>\n";
	return($select);
}

?>