<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/function.php"; ?>

 
 
<?php

    if(isset($_POST['submit']))
    {
        $username = trim($_POST['username']);
        $email    = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        $error_array = 
        [
            'username'=> '',
            'email'=> '',
            'password'=> ''
        ];
        
        if(strlen($username) < 4)
        {
            $error_array['username'] = 'Username need to be longer';
        }
        
        if($username == '')
        {
            $error_array['username'] = 'Username cannot be empty';
        }
        
        if(is_username_exists($username))
        {
            $error_array['username'] = 'Username already exists, pick another one';
        }
        
        if($email == '')
        {
            $error_array['email'] = 'Email cannot be empty';
        }
        
         if(is_user_email_exists($email))
        {
            $error_array['email'] = 'Email already exists, pick another one, <a href="index.php">Please login</a>';
        }
        
         if($password == '')
        {
            $error_array['password'] = 'Password cannot be empty';
        }
        
        if(strlen($password) < 4)
        {
            $error_array['password'] = 'Password need to be longer';
        }
        
        foreach($error_array as $key => $value)
        {
            if(empty($value))
            {
                unset($error_array[$key]);
            }
        }
        
        if(empty($error_array))
        {
            register_user($username, $email, $password);
            
        }
                 
    }
//    else
//    {
//        $message = "";
//    }

?>   

    <!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-center">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
<!-- <h5><?php echo isset($message) ? $message : ''; ?>/?php //echo isset($message1) ? $message1 : ''; ? </h5>-->
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on"
                            value="<?php echo isset($username) ? $username : '' ?>"
                            >
                <p class="alert-danger"><?php echo isset($error_array['username']) ? $error_array['username'] : '' ?></p>
                                                     
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on"
                            value="<?php echo isset($email) ? $email : '' ?>"
                            >
                <p class="alert-danger"><?php echo isset($error_array['email']) ? $error_array['email'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                <p class="alert-danger"><?php echo isset($error_array['password']) ? $error_array['password'] : '' ?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
