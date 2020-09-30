<?php

    if(isset($_GET['p_id']))
    {
        $theget_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $theget_post_id ";
    
    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id))
    {
        $post_id            = escape($row['post_id']);
        $post_category_id   = escape($row['post_category_id']);
        $post_title         = escape($row['post_title']);
        $post_author_id     = escape($row['post_author']);
        $post_date          = escape($row['post_date']);
        $post_image         = escape($row['post_image']);
        $post_content       = escape($row['post_content']);
        $post_tags          = escape($row['post_tags']);
        $post_comment_count = escape($row['post_comment_count']);
        $post_status        = escape($row['post_status']);
    }

    if(isset($_POST['update_post']))
    { 
        
        $post_category_id   = escape($_POST['post_category']);
        $post_title         = escape($_POST['post_title']);
        $post_author_id     = escape($_POST['post_author']);
        $post_status        = escape($_POST['post_status']);
               
        $post_image         = escape($_FILES['image']['name']);
        $post_image_temp    = escape($_FILES['image']['tmp_name']);
        
        $post_content       = escape($_POST['post_content']);
        $post_tags          = escape($_POST['post_tags']);     
        
    move_uploaded_file($post_image_temp,"../images/$post_image");
        
        if(empty($post_image))
        {
        $query = "SELECT * FROM posts WHERE post_id = $theget_post_id ";
        $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image))
            {
                $post_image = $row['post_image'];
            }
        
        }
        
        if(empty($post_category_id))
        {
        $query = "SELECT * FROM posts WHERE post_id = $theget_post_id ";
        $select_category = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_category))
            {
                $post_category_id = $row['post_category_id'];
            }
        
        }
        
        if(empty($post_author_id))
        {
        $query = "SELECT * FROM posts WHERE post_id = $theget_post_id ";
        $select_author = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_author))
            {
                $post_author_id = $row['post_author'];
            }
        
        }
       
        $query = "UPDATE posts SET ";
        $query .="post_title = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date = now(), ";
        $query .="post_author = '{$post_author_id}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags = '{$post_tags }', ";
        $query .="post_content = '{$post_content}', ";
        $query .="post_image = '{$post_image}' ";
        $query .="WHERE post_id = $theget_post_id ";
        
        $update_post_query = mysqli_query($connection, $query);
        
        confirm_query($update_post_query);
        
        echo "<p class='bg-success'>Post Updated. <a href='/cms/post.php?p_id={$theget_post_id}'>View Post</a>
        or <a href='admin_posts.php'>Edit More</a> </p>";
                       
        //header("Location: admin_posts.php");

    }
?>   
<form action="" method="post" enctype="multipart/form-data">
    
  <div class="form-group">
     <label for="title">Post Title</label> 
     <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">     
  </div>
      
  <div class="form-group">
     <label for="title">Post Catagory</label> <br>
   <select name="post_category" id="">
       
<?php
       
//$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
//$select_the_categories = mysqli_query($connection, $query);
//
//confirm_query($select_the_categories); 
//
//while($row = mysqli_fetch_array($select_the_categories))
//{
//   $the_cat_id    = escape($row['cat_id']);
//   $the_cat_title = escape($row['cat_title']);
//}
//
// echo "<option value=''>{$the_cat_title}</option>";
    
      $query = "SELECT * FROM categories";
      $select_categories = mysqli_query($connection, $query);
       
      confirm_query($select_categories);
       
      while($row = mysqli_fetch_assoc($select_categories ))
      {
          $cat_id    = escape($row['cat_id']);
          $cat_title = escape($row['cat_title']);
          
          if($cat_id == $post_category_id)
          {
             echo "<option selected value='$cat_id'>{$cat_title}</option>";
          }
          else
          {
            echo "<option value='$cat_id'>{$cat_title}</option>";
          }      
      }

?>
   </select>   
  </div> 
 
<div class="form-group">
     <label for="title">Post Author</label> <br>
   <select name="post_author" id="">
       
<?php
       
//  $select_the_users_query = "SELECT * FROM users WHERE user_id = {$post_author_id} ";
//  $select_the_users = mysqli_query($connection, $select_the_users_query);
//
//  confirm_query($select_the_users); 
//
//   while($row = mysqli_fetch_array($select_the_users))
//   {
//       $the_user_id    = escape($row['user_id']);
//       $the_username   = escape($row['username']);
//   }
//
//     echo "<option value='{$the_user_id}'>{$the_username}</option>";

       
      $select_all_user_query = "SELECT * FROM users ";
      $select_all_user = mysqli_query($connection, $select_all_user_query);
       
      confirm_query($select_all_user);
       
      while($row = mysqli_fetch_assoc($select_all_user ))
      {
          $user_id    = escape($row['user_id']);
          $username   = escape($row['username']);
          
          if($user_id == $post_author_id)
          {
             echo "<option selected value='$user_id'>{$username}</option>";
          }
          else
          {
            echo "<option value='$user_id'>{$username}</option>";
          }  
          
      }

?>
   </select>   
  </div>      
<!--
  <div class="form-group">
     <label for="post_author">Post Author</label> 
     <input type="text" class="form-control" name="post_author" value="<?php //echo $post_author_id; ?>">     
  </div>
-->
      
<!--
  <div class="form-group">
     <label for="post_ststus">Post Status</label> 
     <input type="text" class="form-control" name="post_status" value="">     
  </div>
-->
     
<div class="form-group">
     <label for="post_ststus">Post Status</label> <br>
 <select name="post_status" id="">
    
     <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>   
    <?php
     
     if($post_status == 'published')
        {
        echo "<option value='unpublished'>unpublished</option>";
        }
    else
        {
        echo "<option value='published'>published</option>";
        }
     
     ?>
   </select>   
  </div> 
      
<div class="form-group">
    <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image">       
  </div>
      
<div class="form-group">
     <label for="post_tags">Post Tags</label> 
     <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">     
  </div>
    
<div class="form-group">
     <label for="post_content">Post Content</label>
<textarea class="form-control" name="post_content" id="body_contact" cols="50" rows="10">  
<?php echo $post_content; ?>
</textarea>    
  </div> 
             
<div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div> 
                                  
</form>