<?php
include('include_fns.php');
$id=$_GET['id'];
$con = db_connect();
mysqli_query($con, "delete from post where post_id='$id'");
header('location:index.php#comment');
?>