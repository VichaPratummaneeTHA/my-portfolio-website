
<table class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>ID</th>
              <th>USERNAME</th>
              <th>FIRSTNAME</th>
              <th>LASTNAME</th>
              <th>EMAIL</th>
              <th>ROLE</th>
         
          </tr>
      </thead>
      
      <tbody>
<?php
          
    $query = "SELECT * FROM users ";
    $select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users))
    {
        $user_id        = $row['user_id'];
        $username       = $row['username'];
        $user_password  = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];       
        $user_email     = $row['user_email'];
        $user_image     = $row['user_image'];
        $user_role      = $row['user_role'];

    
    echo "<tr>";
    echo "<td>$user_id</td>";   
//    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id "; 
//    
//    $select_categories_id = mysqli_query($connection, $query);
//        
//    while($row = mysqli_fetch_assoc($select_categories_id))
//    {
//        $cat_id    = $row['cat_id'];
//        $cat_title = $row['cat_title'];
//
//    }
    echo "<td>$username</td>";
        
    echo "<td>$user_firstname</td>";
    echo "<td>$user_lastname</td>";
    echo "<td>$user_email</td>";
    echo "<td>$user_role</td>";
        
//    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
//        
//    $select_post_id_query = mysqli_query($connection, $query);
//    
//    while($row = mysqli_fetch_assoc($select_post_id_query))
//    {
//        $post_id = $row['post_id'];
//        $post_title = $row['post_title'];
//
//    }
           
    echo "<td><a href='admin_users.php?change_to_admin={$user_id}'>admin</a></td>";
    echo "<td><a href='admin_users.php?change_to_subscriber={$user_id}'>subscriber</a></td>";
        
    echo "<td><a href='admin_users.php?source=admin_edit_user&edit_id={$user_id}'>Edit</a></td>";   
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='admin_users.php?delete={$user_id}'>Delete</a></td>";   
    echo "</tr>";
                 
    }
?>
      </tbody>
  </table>

<?php


    if(isset($_GET['change_to_admin']))
    {
        $the_user_id = $_GET['change_to_admin'];
        
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $chang_to_admin_query = mysqli_query($connection, $query);
        
        header("Location: admin_users.php");
        
    }

    if(isset($_GET['change_to_subscriber']))
    {
        $the_user_id = $_GET['change_to_subscriber'];
        
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $chang_to_subscriber_query = mysqli_query($connection, $query);
        
        header("Location: admin_users.php");
        
    }

    if(isset($_GET['delete']))
    {
        if(isset($_SESSION['user_role']))
        {
            if($_SESSION['user_role'] == 'admin')
            {
                $the_user_id = escape($_GET['delete']);
        
                $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
                $delete_user_query = mysqli_query($connection, $query);

               header("Location: admin_users.php");
            }
        }
        
        
    }
?>    
  