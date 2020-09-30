<?php
    if(isset($_POST['create_post']))
    {
        $post_title       = escape($_POST['title']);
        $post_category_id = escape($_POST['post_category']);
        $post_author_id   = escape($_POST['post_author']);
        //$post_status      = $_POST['post_status'];
        
        $post_image       = escape($_FILES['image']['name']);
        $post_image_temp  = escape($_FILES['image']['tmp_name']);
        
        $post_tags        = escape($_POST['post_tags']);
        $post_content     = escape($_POST['post_content']);
        $post_date        = date('d-m-y');
        
        $post_comment_count = 0;
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        
        $query .="VALUES({$post_category_id}, '{$post_title}', '{$post_author_id}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, 'draft' ) ";
        
        $create_post_query = mysqli_query($connection, $query);
        
        confirm_query($create_post_query);
        
        $the_new_create_post_id =mysqli_insert_id($connection);
        
        echo "<p>Post-Created.<a href='/cms/post.php?&p_id={$the_new_create_post_id}'>View Post</a> or <a href='/cms/admin/admin_posts.php?source=admin_edit_post&p_id={$the_new_create_post_id}'>Edit Post</a> </p>";
        
 //cms/admin/admin_posts.php?source=admin_edit_post&p_id=29
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    
  <div class="form-group">
     <label for="title">Post Title</label> 
     <input type="text" class="form-control" name="title">     
  </div>
      
  <div class="form-group">
   
    <label for="post_category">Post Catagory</label> <br>
 <select name="post_category" id="" >
       
<?php
       
      $query = "SELECT * FROM categories";
      $select_categories = mysqli_query($connection, $query);
       
      confirm_query($select_categories);
       
      echo "<option value='Select Catagory'>Select Catagory</option>";
     
      while($row = mysqli_fetch_assoc($select_categories ))
      {
          $cat_id    = escape($row['cat_id']);
          $cat_title = escape($row['cat_title']);
          
      
      echo "<option value='$cat_id'>{$cat_title}</option>";
      }

?>
   </select>   
  </div> 
      
  <div class="form-group">
    
     <label for="post_author">Post Author</label> <br>
     <select name="post_author" id="">
<?php
      $select_all_users_query = "SELECT * FROM users ";
      $select_all_users = mysqli_query($connection, $select_all_users_query);
         
      confirm_query($select_all_users);
         
      echo "<option value='Select User'>Select User</option>";
          
      while($row = mysqli_fetch_assoc($select_all_users))
      {
          $user_id  = escape($row['user_id']);
          $username = escape($row['username']);
          
        echo "<option value='{$user_id}'>{$username}</option>";
      }
         
?>         
     </select>
<!--     <input type="text" class="form-control" name="post_author">     -->
  </div>
      
<!--
  <div class="form-group">
     <label for="post_ststus">Post Status</label> 
     <input type="text" class="form-control" name="post_status">     
  </div>
-->
      
<!--
<div class="form-group">
 <select name="post_status" id="">
    
     <option value="">Select Options</option>
     <option value="published">published</option>
     <option value="unpublished">unpublished</option>

   </select>   
  </div> 
-->

      
<div class="form-group">
     <label for="post_image">Post Image</label> 
     <input type="file" name="image">     
  </div>
      
<div class="form-group">
     <label for="post_tags">Post Tags</label> 
     <input type="text" class="form-control" name="post_tags">     
  </div>
    
<div class="form-group">
     <label for="post_content">Post Content</label>
<textarea class="form-control" name="post_content" id="body_contact" cols="50" rows="10"></textarea>    
  </div> 
             
<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div> 
                                  
</form>