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
    
    if(isset($_GET['p_id']))
    {
        $the_post_id      = $_GET['p_id'];
        $the_post_author_id  = $_GET['author_id'];
    }

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
    {
        $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author_id}' ORDER BY post_id DESC ";            
    }

    else
    {
       $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author_id}' AND post_status = 'published' ORDER BY post_id DESC ";                      
    } 



    $select_author_posts_query = mysqli_query($connection, $query);

    if(!$select_author_posts_query)
    {
        die("Query Failed". mysqli_error($connection));
    }

    $count = mysqli_num_rows($select_author_posts_query);

    if($count < 1)
    {
        echo "<h2 class='text-center'> No Post Available</h2>";
    }
    else
    {


  while($row = mysqli_fetch_assoc($select_author_posts_query))
      
  {
      $post_id        = $row['post_id'];
      $post_title     = $row['post_title'];
      $post_author_id = $row['post_author'];
      $post_date      = $row['post_date'];
      $post_image     = $row['post_image'];
      $post_content   = $row['post_content'];
  
?>      
       <h1 class="page-header">
            Post
<!-- <small>Secondary Text</small>-->
        </h1>

        <!-- First Blog Post -->
        <h2>
            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a> 

        </h2>
<?php
        $select_author_query = "SELECT * FROM users WHERE user_id = {$post_author_id} ";
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
            All Post BY : <?php echo $username ?>
        </p>
        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>
        
<!-- <a class="btn btn-primary" href="#">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>-->

        <hr>
      
<?php
      
  } }
                
?>   
                  
            </div>
              <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>           
        </div>

        <hr>

<!-- footer -->
<?php include "includes/footer.php"?>

