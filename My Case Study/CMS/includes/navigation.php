<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
           
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms">CMS Front</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               
                <ul class="nav navbar-nav">
                
    <?php
                    
       $query = "SELECT * FROM categories ORDER BY cat_id DESC LIMIT 5 ";
                    
       $select_all_categories_query = mysqli_query($connection, $query);
    
        while($row = mysqli_fetch_assoc($select_all_categories_query))
        {
            $cat_id    = $row['cat_id'];
            $cat_title = $row['cat_title'];
            
            $category_class_active = '';
            $contact_class_active = '';
            $registration_class_active = '';
                       
            $page_name = basename($_SERVER['PHP_SELF']);
            $registration_page = 'registration.php';
            $contact_page = 'contact.php';
            
            if(isset($_GET['category']) && $_GET['category'] == $cat_id)
            {
                $category_class_active = 'active';                
            }
            else if ($page_name == $contact_page)
            {
                $contact_class_active = 'active';
            }
            else if ($page_name == $registration_page)
            {
                $registration_class_active = 'active';
            }
            
            echo "<li class='$category_class_active' ><a href='/cms/category_sidebar/$cat_id'>{$cat_title}</a></li>";
                    //category_sidebar.php?category=$1 [NC,L]
        }
                    
    ?>
    
    <li class='<?php echo $contact_class_active ?>'><a href="/cms/contact">Contact Us</a></li>

    
    <li class='<?php echo $registration_class_active ?>'><a href="/cms/registration">Registration</a></li>

    
    <?php
        
        if(isset($_SESSION['user_role']))
        {
            if($_SESSION['user_role'] == 'admin')
            {
               if(isset($_GET['p_id']))
                   
                {
                    $the_p_id = $_GET['p_id'];

                    echo "<li><a href='/cms/admin/admin_posts.php?source=admin_edit_post&p_id={$the_p_id}'>Edit Post</a></li>";
                }
            }
           
        }
                    
    ?>
    
    <?php
		
		if(isset($_SESSION['user_role']))
		{
			if($_SESSION['user_role'] == 'admin' )
			{
				 echo "<li><a href='/cms/admin'>Admin</a></li>";
			}	
			else
			{
				 echo "";
			}
		}
					
	?>
    

<!--
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
-->
                </ul>
            </div>
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
</nav>