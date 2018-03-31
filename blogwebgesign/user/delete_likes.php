<?php
include('include_fns.php');
$id=$_GET['id'];
$con = db_connect();
mysqli_query($con, "delete from likelist where id='$id'");
header('location:index.php#likes');
?>