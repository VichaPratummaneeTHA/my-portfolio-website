<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12"  >
                        <h1 class="page-header text-center">
                            Welcome to Admin
                            <small> <?php echo $_SESSION['username']?> </small>
                        </h1>
                    
                    </div>
                </div>
                <!-- /.row -->               
       
                <!-- /.row -->
                
<div class="row">
   
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
         
                        <!----- function recordCount  ----->                                    
        <div class='huge'><?php echo $count_post = recordCount('posts'); ?></div>   
                                  
                        <div>Posts</div>                      
                    </div>
                </div>
            </div>
            <a href="./admin_posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                               
                            <!-- function recordCount  -->                          
         <div class='huge'><?php echo $count_comment = recordCount('comments'); ?></div>   
                
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./admin_comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                                <!-- function recordCount  -->                                                
           <div class='huge'><?php echo $count_user = recordCount('users'); ?></div>   
                                        
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./admin_users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                                <!-- function recordCount  -->             
         <div class='huge'><?php echo $count_category = recordCount('categories'); ?></div>   
                 
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
</div>
                <!-- /.row -->
<?php
 
//     ----------- function check_status_post ----------------
                
//    $query ="SELECT * FROM posts WHERE post_status = 'Draft' ";
//    $select_draft_post = mysqli_query($connection, $query);
    $count_draft_post = check_status_post('posts', 'post_status', 'draft');            
                
                
//    $query ="SELECT * FROM posts WHERE post_status = 'published' ";
//    $select_published_post = mysqli_query($connection, $query);
    $count_published_post = check_status_post('posts', 'post_status', 'published');
                
//    $query ="SELECT * FROM posts WHERE post_status = 'unpublished' ";
//    $select_unpublished_post = mysqli_query($connection, $query);
    $count_unpublished_post = check_status_post('posts', 'post_status', 'unpublished');
                
//      ----------- function check_status_comment ----------------
                
//    $query ="SELECT * FROM comments WHERE comment_status = 'approved' ";
//    $select_approved_comment = mysqli_query($connection, $query);
    $count_approved_comment = check_status_comment('comments', 'comment_status', 'approved');
                
//    $query ="SELECT * FROM comments WHERE comment_status = 'unapproved' ";
//    $select_unapproved_comment = mysqli_query($connection, $query);
    $count_unapproved_comment = check_status_comment('comments' , 'comment_status', 'unapproved');
                
                
//      ----------- function check_status_comment ----------------
                
//    $query ="SELECT * FROM users WHERE user_role = 'admin' ";
//    $select_admin_user = mysqli_query($connection, $query);
    $count_admin_user = check_user_role('users', 'user_role', 'admin');
                
//    $query ="SELECT * FROM users WHERE user_role = 'subscriber' ";
//    $select_subscriber_user = mysqli_query($connection, $query);
    $count_subscriber_user = check_user_role('users', 'user_role', 'subscriber');
                
?>
                
<div class="row">
    
<script type="text/javascript">
    
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() 
    {
        var data = google.visualization.arrayToDataTable
        ([
          ['DATA', 'COUNT'],
            
<?php
  
        $element_text  =['Draft Post', 'Published', 'Unpublished', 'Approved Comments', 'Unapproved Comments', 'Admin', 'Subscriber', 'All Categories'];
        $element_count =[$count_draft_post, $count_published_post, $count_unpublished_post, $count_approved_comment, $count_unapproved_comment, $count_admin_user , $count_subscriber_user, $count_category];
            
        for($i = 0; $i < 8; $i++)
        {
            echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";
        }
            
?>      
        ]);

        var options = 
        {
          chart: 
        {
            title: '',
            subtitle: '',
        }
            
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    
</script>
    
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>
