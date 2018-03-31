<?php

	function check_auth_user() {
		global $_SESSION;
		if (isset($_SESSION['auth_user'])) {
			return true;
		}else {
			return false;
		}
	}

	function login_form() {
		?>

              <center><h5>Log In</h5></center>
                    <form method="post" action="login.php">
                      <div class="input-field">
                        <input type="text" name="username" class="validate" required />
                        <label for="username">Username</label>
                      </div>
                      <div class="input-field">
                        <input type="password" name="password" class="validate" required />
                        <label for="password">Password</label>
                      </div>
                      <div class="input-field">
                      <center><button type="submit" name="submit" value="Log In" class="btn waves-effect waves-light red darken-2"/>Log In</button></center>
                    </div>
                    </form>
		<?php
	}

	function login($username, $password) {
		$con = db_connect();
		if (!$con) {
			return 0;
		}
		$query = "select * from writers where username = '$username' and password = sha1('$password')";
		$result = mysqli_query($con, $query);
		if (!$result) {
			trigger_error('Invalid query: '.mysqli_error()." in".$query);
			return 0;
		}
		if (mysqli_num_rows($result)>0) {
			return 1;
		}else{
			return 0;
		}
	}

	function check_permission($username, $story){
		$con = db_connect();
		if(!$con) {
			return 0;
		}
		if(!$_SESSION['auth_user']) {
			return 0;
		}
		$query = "select * from writer_permissions wp, stories s where wp.category = s.category and s.id = $story";
		$result = mysqli_query($con, $query);
		if(!$result) {
			return 0;
		}
		if(mysqli_num_rows($result)>0) {
			return 1;
		}else {
			return 0;
		}
	}
?>