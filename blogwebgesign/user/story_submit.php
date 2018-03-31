<?php  
    # add / modify story record  
    include_once('include_fns.php');  
  
    $con = db_connect();  
  
    $headline = stripslashes($_REQUEST['headline']);
    $headline = mysqli_real_escape_string($con, $headline); 
    $category = stripslashes($_REQUEST['category']);
    $category = mysqli_real_escape_string($con, $category);
    $location = stripslashes($_REQUEST['location']);
    $location = mysqli_real_escape_string($con, $location);
    $time = time();   
    $story_text = stripslashes($_REQUEST['story_text']);
    $story_text = mysqli_real_escape_string($con, $story_text);
 
  
    if (isset($_REQUEST['story']) && $_REQUEST['story']!='') {  
        # it's an update  
        $story = $_REQUEST['story'];  
  
        $query = "update stories   
                  set headline = '$headline',  
                      story_text = '$story_text',
                      location = '$location',  
                      category = '$category',  
                      modified = $time
                  where id = $story";
        $result = mysqli_query($con, $query);  
    }else{  
        // it's a new story  
        $stmt = $con->prepare("insert into stories  
                  (headline,story_text,category,writer,created,modified,location)  
                  values (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss",$headline,$story_text,$category,$writer,$time,$time,$location);
    $headline = stripslashes($_REQUEST['headline']);
    $headline = mysqli_real_escape_string($con, $headline); 
    $writer = $_SESSION['auth_user'];
    $category = stripslashes($_REQUEST['category']);
    $category = mysqli_real_escape_string($con, $category);
    $location = stripslashes($_REQUEST['location']);
    $location = mysqli_real_escape_string($con, $location);
    $time = time();   
    $story_text = stripslashes($_REQUEST['story_text']);
    $story_text = mysqli_real_escape_string($con, $story_text);
    $stmt->execute();
    $stmt->close();
    }
      
  
 
  
    if ((isset($_FILES['picture']['name']) &&   
        is_uploaded_file($_FILES['picture']['tmp_name']))) {  
        # there is uploaded picture  
        if (!isset($_REQUEST['story']) || $_REQUEST['story']=='') {  
            $story = mysqli_insert_id($con);  
            // mysql_insert_id  return the auto generated id used in the last query  
        }  
        $type = basename($_FILES['picture']['type']);  
  
        switch ($type) {  
            case 'jpeg':  
            case 'pjpeg':  
            case 'png':  
            case 'jpg':  
                $filename = "images/$story.jpg";  
                move_uploaded_file($_FILES['picture']['tmp_name'], '../'.$filename);  
                $query = "update stories   
                          set picture = '$filename'  
                          where id = $story";  
                $result = mysqli_query($con, $query);  
                break;  
              
            default:  
                echo 'Invalid picture format:'.$_FILES['picture']['type'];  
                break;  
        }  
    }else{  
        // there is no image file to upload or didn't get the file's info  
        echo 'Possible file upload attack:';  
        echo "filename '".$_FILES['picture']['tmp_name']."'.";  
    }  
      
    header('Location: '.$_REQUEST['destination']);  
?>  