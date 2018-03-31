<?php  
    # Script User to Create or Edit a Story  
    include_once('include_fns.php');
    include_once('header.php');
    if (isset($_REQUEST['story'])) {
        $story = get_story_record($_REQUEST['story']);  
    }
?>  
<div class="container"> 

  <div class="fixed-action-btn">
    <a class="btn-floating hoverable tooltipped btn-large red" data-position="left" data-delay="50" data-tooltip="Back to Top" href="#top">
      <i class="material-icons">publish</i>
    </a>
  </div>
    
<form action = "story_submit.php" method = "POST" enctype="multipart/form-data">  
    <input type = "hidden" name="story" value = "<?php if (isset($_REQUEST['story'])) {echo $_REQUEST['story'];}?>">  
    <input type = "hidden" name = "destination"  
            value = "<?php echo $_SERVER['HTTP_REFERER']; ?>">  
  
    <table>  
        <tr>  
            <td>Headline</td>  
        </tr>  
  
        <tr>  
            <td><input placeholder="The headline is better to be short. :)" size="80" name="headline"  
                        value ="<?php
                        if (isset($_REQUEST['story'])) { echo $story['headline'];}?>" ></td>  
        </tr>  
        <tr>  
            <td>Location Name</td>  
        </tr>  
  
        <tr>  
            <td><input placeholder="You can add a location for users to find, better with post code." size="80" name="location"  
                        value ="<?php
                        if (isset($_REQUEST['story'])) { echo $story['location'];}?>" >
            </td>  
        </tr>  
        <tr>  
            <td>Category</td>  
        </tr>  
  
        <tr>  
            <td>  
                <?php  
                    $query = "select * from category"; 
                    echo '<div class="input-field col s6">';
                    echo query_select('category', $query); 
                    echo '</div';   
                ?>  
            </td>  
        </tr>  
  
        <tr>  
            <td>Story text (can contain HTML tags)</td>  
        </tr>  
  
        <tr>  
            <td><div class="input-field col s12">  
                <textarea name="story_text" class="materialize-textarea">  
                    <?php
                    if (isset($_REQUEST['story'])) {
                    echo $story['story_text'];}
                    ?>  
                </textarea></div> 
            </td>  
        </tr>    

        <tr>  
            <td>Picture</td>  
        </tr>  
        <tr>  
            <td><input type="file" name= "picture"></td>  
        </tr>  
  
        <?php
        if (isset($_REQUEST['story'])) { 
            if ($story['picture']) { 
                $width = '400px';  
                $height = 'auto';
        ?>  
  
            <tr>  
                <td>  
                    <center><img src="<?php echo "../".$story['picture'];?>"  
                            class="hoverable materialboxed" width="<?php echo $width;?>" height="<?php echo $height;?>">  </center>
                </td>  
            </tr>  
        <?php  
            }  
        }
        ?>   
    </table>  
    <center><button type="submit" name="post" class="hoverable btn waves-effect waves-light red darken-2"/>Submit</button> 
</form>
<button onClick="javascript :history.back(-1);" class="hoverable btn waves-effect waves-light red darken-2">Cancel</button></center>
</div>
<?php
    include_once('footer.php');
?>