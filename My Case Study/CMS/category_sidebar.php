<?php include "includes/db.php"?>

<!-- Header -->
<?php include "includes/header.php"?>
<?php  include "admin/function.php"; ?>

    <!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

<?php
  
    if(isset($_GET['category']))
    {
        $post_category_id = $_GET['category'];
        
        if(isset($_SESSION['username']))
        {
            
            if(is_admin($_SESSION['username']))
            {
//                echo 'stmt1 being used<br>';
//                $statement_1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? ");
              $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id ORDER BY post_id DESC ";
                
            }
                     
        }

        else
        {
//            echo 'stmt2 being used<br>';
//            $statement_2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");
//                
//            $published = 'published';
           $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published' ORDER BY post_id DESC ";                      
        }
        
//        if(isset($statement_1))
//        {
//            echo 'stmt1 isset<br>';
//            mysqli_stmt_bind_param($statement_1, "i", $post_category_id );
//            
//            mysqli_stmt_execute($statement_1);
//            
//            mysqli_stmt_bind_result($statement_1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
//            
//            $statement = $statement_1;
//        }
//        else
//        {
//            echo 'stmt2 isset<br>';
//            mysqli_stmt_bind_param($statement_2, "is", $post_category_id, $published);
//            
//            mysqli_stmt_execute($statement_2);
//            
//            mysqli_stmt_bind_result($statement_2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
//            
//            $statement = $statement_2;
//        }

        $select_all_posts_query = mysqli_query($connection, $query);
        
        if(!$select_all_posts_query)
        {
            die("Query Failed". mysqli_error($connection));
        }
        
        $count = mysqli_num_rows($select_all_posts_query);
        
        if($count < 1)
        {
            //echo '<h2>No Posts To Show</h2>';
            echo "<h2 class='text-center'> No Post Available</h2>";
        }
        else
        {
//            

        while($row = mysqli_fetch_assoc($select_all_posts_query))
      
        {
          $post_id     = $row['post_id'];
          $post_title  = $row['post_title'];
          $post_author = $row['post_author'];
          $post_date   = $row['post_date'];
          $post_image  = $row['post_image'];
          $post_status = $row['post_status'];
          $post_content= substr($row['post_content'], 0, 250);
    //      
//      if($post_status == 'published')
//      {
          
     
?>      
<!--
       <h1 class="page-header">
            Post
-->
<!-- <small>Secondary Text</small>-->
<!--    </h1>-->

        <!-- First Blog Post -->

        <h2>
            <a href="/cms/post/<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    <!--^post/(\d+)$ post.php?p_id=$1 [NC,L]-->
        </h2>
        
        
<?php
        $select_author_query = "SELECT * FROM users WHERE user_id = {$post_author} ";
        $select_author       = mysqli_query($connection, $select_author_query);
       
        if(!$select_author)
        {
            die("Query Failed". mysqli_error($connection));
        }
       
        while($row = mysqli_fetch_assoc($select_author))
        {
            $user_id  = $row['user_id'];
            $username = $row['username'];
        }
                
?>
        <p class="lead">
            by <a href="/cms/author_post.php?author_id=<?php echo $user_id ?>&p_id=<?php echo $post_id ?>"><?php echo $username ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
        <hr>
        <img class="img-responsive" src="/cms/images/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>
        <a class="btn btn-primary" href="#">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
    

<?php 
      
  }   }   }
//}
        else
     {
         header("Location: index.php");
     }

                
?>               
                                         
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
<!-- footer -->
<?php include "includes/footer.php"?>

