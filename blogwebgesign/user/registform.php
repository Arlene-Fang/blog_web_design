<?php
include_once('include_fns.php');
$con = db_connect();
?>
<?php

                                        // If form submitted, insert values into the database.
                                        if (isset($_REQUEST['username'])){
                                            $username = stripslashes($_REQUEST['username']);
                                            $username = mysqli_real_escape_string($con,$username);

                                            $signup_date = date("Y-m-d H:i:s");
                                            $sql_u = "SELECT * FROM writers WHERE username='$username'";
                                            $res_u = mysqli_query($con, $sql_u);

                                            if (mysqli_num_rows($res_u) > 0) {
                                              echo "<script type='text/javascript'>alert('Oops! Username already exists.');location.href='register.php'</script>";   
                                            }else{
                                                  $stmt = $con->prepare("INSERT INTO writers (username, full_name, password, signup_date, email) 
                                                          VALUES (?, ?, ?, ?, ?)");
                                                  $stmt->bind_param("sssss", $username, $fullname, $password, $signup_date, $email);
                                                                                              $username = stripslashes($_REQUEST['username']);
                                            $username = mysqli_real_escape_string($con,$username);
                                            $fullname = stripslashes($_REQUEST['fullname']);
                                            $fullname = mysqli_real_escape_string($con,$fullname);
                                            $email = stripslashes($_REQUEST['email']); 
                                            $email = mysqli_real_escape_string($con,$email);
                                            $password = stripslashes($_REQUEST['password']);
                                            $password = mysqli_real_escape_string($con,$password);
                                            $password = sha1($password);
                                            $cpassword = stripslashes($_REQUEST['cpassword']);
                                            $stmt->execute();
                                            $stmt->close();
                                            $con->close();   
$con = db_connect();
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
{
    if($_FILES["file"]["size"] < 512500){   // 小于 500 kb)
        if ($_FILES["file"]["error"] > 0)
        {
            echo "error: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            
            // 判断当期目录下的 upload 目录是否存在该文件
            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("avatars/" . $_FILES["file"]["name"]))
            {
                echo "<script type='text/javascript'>alert('Sorry there are something wrong, please register again :(');location.href='register.php';</script>";
            }
            else
            {
                $sql = "select max(id) from writers";
                $ccc = mysqli_query($con, $sql);
                $row = mysqli_fetch_row($ccc);
                $filename = 'avatars/'.$row[0].'.'.$extension;
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["file"]["tmp_name"], "../" . $filename);
                $query = "update writers set avatar='$filename' where id ='$row[0]'";
                $results = mysqli_query($con, $query);

                                                      
            }
        }
        echo "<script type='text/javascript'>alert('Successfully sign up with avatar, you can log in now.');location.href='index.php';</script>";
    }
                
    else{
        echo "<script type='text/javascript'>alert('Please upload less than 500 kb avatar :)');location.href='register.php';</script>";
    } 
}   echo "<script type='text/javascript'>alert('Successfully sign up without avatar, you can log in now.');location.href='index.php';</script>";
}
}
?>