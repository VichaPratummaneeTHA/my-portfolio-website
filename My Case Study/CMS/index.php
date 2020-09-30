<?php include "includes/db.php"?>

<!-- Header -->
<?php include "includes/header.php"?>

    <!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

<?php
    
    $per_page = 3;
    
    if(isset($_GET['page'])) 
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = "";
    }

    if($page == "" || $page == 1 )
    {
        $page_1 = 0;
    }
    else
    {
        $page_1 = ($page * $per_page) - $per_page;
    }

    $post_count_query  = "SELECT * FROM posts ";    
    $find_count        = mysqli_query($connection, $post_count_query);    
    $count             = mysqli_num_rows($find_count);

    $divide_count_page = ceil($count / $per_page);

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
        
        {
            $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT {$page_1}, {$per_page} ";            
        }

        else
        {
            $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT {$page_1}, {$per_page} ";                       
        } 

    $select_all_posts_query = mysqli_query($connection, $query);

        if(!$select_all_posts_query)
        {
            die("Query Failed". mysqli_error($connection));
        }

        $count = mysqli_num_rows($select_all_posts_query);

        if($count < 1)
        {
            echo "<h2 class='text-center'> No Post Available</h2>";
        }
        else
        {   

  while($row = mysqli_fetch_assoc($select_all_posts_query))
      
  {
      $post_id          = $row['post_id'];
      $post_title       = $row['post_title'];
      $post_author      = $row['post_author'];
      $post_date        = $row['post_date'];
      $post_image       = $row['post_image'];
      $post_category_id = $row['post_category_id'];
      $post_content= substr($row['post_content'], 0, 250);
      
      //$post_status = $row['post_status'];
      
//      if($post_status == 'published')
//      {
?>      
<?php
        $select_categories_query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
      
        $select_categories = mysqli_query($connection, $select_categories_query);
      
        if(!$select_categories)
        {
            die("Query Failed ". mysqli_error($connection));
        }
      
        while($row = mysqli_fetch_assoc($select_categories))
            
        {
            $cat_id    = $row['cat_id'];
            $cat_title = strtoupper($row['cat_title']);
        }               
?> 
<!--
       echo "<li class='$category_class_active' ><a href='/cms/category_sidebar/$cat_id'>{$cat_title}</a></li>";
                    //category_sidebar.php?category=$1 [NC,L]     
-->
       <h2 class="page-header">
           
           <a href="/cms/category_sidebar/<?php echo $cat_id ?>"><?php echo $cat_title ?></a>
<!-- <small>Secondary Text</small>-->
        </h2>

        <!-- First Blog Post -->
        <h2>
            <a href="post/<?php echo $post_id ?>"><?php echo $post_title ?></a>
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
            by <a href="author_post.php?author_id=<?php echo $user_id ?>&p_id=<?php echo $post_id ?>"><?php echo $username ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
        <hr>
        <a href="post.php?p_id=<?php echo $post_id ?>">
         <img class="img-responsive" src="/cms/images/<?php echo $post_image ?>" alt="">
         </a>      
        
        <hr>
        <p><?php echo $post_content ?></p>
        <a class="btn btn-primary" href="post/<?php echo $post_id ?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
      
<?php
      
  }  } //}
                
?>               
                                         
        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
<?php
         for($i =1; $i <= $divide_count_page; $i++)
         {
             if($i == $page)
             {
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
             }
             else
             {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";                
             }
         }

?>            
        </ul>
        
<!-- footer -->
<?php include "includes/footer.php"?>

