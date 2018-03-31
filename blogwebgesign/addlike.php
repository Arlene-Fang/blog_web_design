<?php
	include_once('include_fns.php');
	$con = db_connect();
    $username = $_SESSION['auth_user'];
    $storyid = $_REQUEST['id'];
    $liketime = date("Y-m-d H:i:s");
    $sql_u = "SELECT * FROM likelist WHERE username='$username' and storyid='$storyid'";
    $res_u = mysqli_query($con, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
        echo "<script type='text/javascript'>alert('Oops! You have already added it.');location.href='id.php?id=".$storyid."'</script>";
    }
    else {
		$stmt = $con->prepare("INSERT INTO likelist (username, storyid, liketime) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $username, $storyid, $liketime);
	    $username = $_SESSION['auth_user'];
	    $storyid = $_REQUEST['id'];
	    $stmt->execute();
	    $stmt->close();
	    $con->close();
		echo "<script type='text/javascript'>alert('Success add!');location.href='id.php?id=".$storyid."'</script>";
    }
?>