<?php

include ("delete_modal.php");

    if(isset($_POST['checkBoxArray']))
    {
        $the_check_box_value = $_POST['checkBoxArray'];
        
        foreach($the_check_box_value as $postcheckvalue_id)
        {
            $bulk_options = $_POST['bulk_options'];
            
            switch($bulk_options)
            {
                case'published':
                    
                    $query  ="UPDATE posts SET post_status = '{$bulk_options}' ";
                    $query .="WHERE post_id = {$postcheckvalue_id} ";
                    
                    $checkbox_published_update = mysqli_query($connection, $query);
                    
                break;
                    
                case'unpublished':
                    
                    $query  ="UPDATE posts SET post_status = '{$bulk_options}' ";
                    $query .="WHERE post_id = {$postcheckvalue_id} ";
                    
                    $checkbox_unpublished_update = mysqli_query($connection, $query);
                    
                break;
                    
                case'draft':
                    
                    $query  ="UPDATE posts SET post_status = '{$bulk_options}' ";
                    $query .="WHERE post_id = {$postcheckvalue_id} ";
                    
                    $checkbox_draft_update = mysqli_query($connection, $query);
                    
                break;
                    
                case'delete':
                    
                    $query  ="DELETE FROM posts WHERE post_id = {$postcheckvalue_id} ";
                    
                    
                    $checkbox_delete = mysqli_query($connection, $query);
                    
                break;
                    
                case'clone':
                    
                    $query ="SELECT * FROM posts WHERE post_id = {$postcheckvalue_id} ";
                    $select_post_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_array($select_post_query))
                    {
                        $post_title         = $row['post_title'];
                        $post_category_id   = $row['post_category_id'];
                        $post_date          = $row['post_date'];
                        $post_author        = $row['post_author'];
                        $post_status        = 'draft';
                        $post_image         = $row['post_image'];
                        $post_tags          = $row['post_tags'];
                        $post_content       = $row['post_content'];
                        $post_comment_count = 0;
    

                    }
                    
                $query ="INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
                $query .="VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}') ";
                    
                $clone_post_query = mysqli_query($connection, $query);
                    
                if(!$clone_post_query)
                {
                    die("Query Failed". mysqli_error($connection));
                }
                    
                  break;
            }
        }
    }

?>

<form action="" method="post">

<table class="table table-bordered table-hover">
     
<div id="bulkOptionContainer" class="col-xs-4">
    
    <select class="form-control" name="bulk_options" id="">
        
        <option value="">Select Option</option>
        <option value="published">Publish</option>
        <option value="unpublished">Unpublish</option>
        <option value="draft">Draft</option>
        <option value="clone">Clone</option>
        <option value="delete">Delete</option>

    </select>
     
</div>   
     
<div class="col-xs-4">
    
    <input class="btn btn-success" type="submit" name="submit" value="Apply">
    <a class="btn btn-primary" href="admin_posts.php?source=admin_add_post">Add New</a>
   
</div>    
      
      <thead>
          <tr>
              <th><input id="selectAllBoxes" type="checkbox"></th>
              <th>ID</th>
              <th>CATEGORY_ID</th>
              <th>TITILE</th>
              <th>AUTHOR</th>
              <th>DATE</th>
              <th>IMAGE</th>
              <th>CONTENT</th>
              <th>TAGS</th>
              <th>COMMENT_COUNT</th>
              <th>STATUS</th>
             
          </tr>
      </thead>
      
      <tbody>
<?php
          
//  $query = "SELECT * FROM posts ORDER BY post_id DESC ";
          
    $query  ="SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_date, posts.post_image, posts.post_content, posts.post_tags, posts.post_status, posts.post_views_count,  categories.cat_id, categories.cat_title ";
    $query .="FROM posts ";
    $query .="LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";
    $query .="ORDER BY posts.post_id DESC ";
          
    $select_posts = mysqli_query($connection, $query);
          
    if(!$select_posts)
    {
        die("Query Faild". mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($select_posts))
    {
        $post_id            = $row['post_id'];
        $post_category_id   = $row['post_category_id'];
        $post_title         = $row['post_title'];
        $post_author_id     = $row['post_author'];
        $post_date          = $row['post_date'];
        $post_image         = $row['post_image'];
        $post_content       = $row['post_content'];
        $post_tags          = $row['post_tags'];
        //$post_comment_count = $row['post_comment_count'];
        $post_status        = $row['post_status'];
        $post_views_count   = $row['post_views_count'];
        $cat_id             = $row['cat_id'];
        $cat_title          = $row['cat_title'];
        
    echo "<tr>";
?>
            
<td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>

<?php
        
    echo "<td>$post_id</td>";
       
// $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";    
//    $select_categories_id = mysqli_query($connection, $query);
//        
//    while($row = mysqli_fetch_assoc($select_categories_id))
//    {
//        $cat_id    = $row['cat_id'];
//        $cat_title = $row['cat_title'];
//
//    }
        
    echo "<td>$cat_title</td>";
        
    echo "<td>$post_title</td>";
        
    $select_author_query = "SELECT * FROM users WHERE user_id = $post_author_id "; 
    
    $select_author = mysqli_query($connection, $select_author_query);
        
    while($row = mysqli_fetch_assoc($select_author))
    {
        $user_id    = $row['user_id'];
        $username   = $row['username'];

    }
    echo "<td>$username</td>";
    echo "<td>$post_date</td>";
    echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
    echo "<td>$post_content</td>";
    echo "<td>$post_tags</td>";
        
    $select_post_comment_query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
    $post_comment = mysqli_query($connection, $select_post_comment_query);
    
//    $row = mysqli_fetch_array($post_comment);
//    $comment_id = $row['comment_id'];
        
    $count_post_comment = mysqli_num_rows($post_comment);    
        
    echo "<td><a href='post_comments.php?id={$post_id}'>$count_post_comment</a></td>";
        
    echo "<td>$post_status</td>";
        
    echo "<td><a href='admin_posts.php?published={$post_id}'>published</a></td>";
    echo "<td><a href='admin_posts.php?unpublished={$post_id}'>unpublished</a></td>";
        
    echo "<td><a class='btn btn-info' href='/cms/post.php?p_id={$post_id}'>View Post</a></td>";
        
    echo "<td><a class='btn btn-success' href='admin_posts.php?source=admin_edit_post&p_id={$post_id}'>Edit</a></td>";
        
    ?>
    
    <form action="" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
        
    <?php echo '<td><input class="btn btn-danger" type="submit" name="delete" value="delete"></td>'; ?>   
        
    </form>
    
    <?php
        
//  echo "<td><a href='javascript:void(0)' class='delete_link' rel='{$post_id}'>Delete</a></td>";
//  echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');  \" href='admin_posts.php?delete={$post_id}'>Delete</a></td>";
        
    echo "<td><a href='admin_posts.php?reset={$post_id}'>{$post_views_count}</a></td>";    
    echo "</tr>";
              
    }
?>
      </tbody>
  </table>
  
</form>

<?php

// if(isset($_GET['approve']))
//    {
//        $the_comment_id = $_GET['approve'];
//        
//    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
//    $approve_comment_query = mysqli_query($connection, $query);
//        
//        header("Location: admin_comments.php");
//        
//    }

    if(isset($_GET['published']))
    {
        $the_post_id = $_GET['published'];
        
        $query ="UPDATE posts SET post_status = 'published' WHERE post_id = $the_post_id ";
        
        $published_post = mysqli_query($connection, $query);
        
        header ("Location: admin_posts.php");
        
    }

    if(isset($_GET['unpublished']))
    {
        $the_post_id = $_GET['unpublished'];
        
        $query ="UPDATE posts SET post_status = 'unpublished' WHERE post_id =" . mysqli_real_escape_string($connection, $the_post_id) . " ";
        
        $unpublished_post = mysqli_query($connection, $query);
        
        header ("Location: admin_posts.php");
        
    }

    if(isset($_GET['reset']))
    {
        $the_post_id = $_GET['reset'];
        
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =". mysqli_real_escape_string($connection, $the_post_id)." ";
        $delete_post_query = mysqli_query($connection, $query);
        
        header("Location: admin_posts.php");
        
    }


    if(isset($_POST['delete']))
    {
        $the_post_id = $_POST['post_id'];
        
        $delet_post_query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_post = mysqli_query($connection, $delet_post_query);
        
        confirm_query($delete_post);
        
        $delete_comment_query = "DELETE FROM comments WHERE comment_post_id = {$the_post_id} ";
        $delete_comment = mysqli_query($connection, $delete_comment_query);
        
        confirm_query($delete_comment);
       
        header("Location: admin_posts.php");
        
    }
?>  
 
<script>

    $(document).ready(function(){
        
        $(".delete_link").on('click', function(){
            
            var postid = $(this).attr("rel");
            
            var delete_url = "admin_posts.php?delete="+ postid +" ";
            
            $(".modal_delete_link").attr("href", delete_url);
            
            $("#delete_modal").modal();
            
        });
        
    });

</script>   
       
  