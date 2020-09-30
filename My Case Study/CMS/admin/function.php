<?php

function escape($string)
{
    global $connection;
    
    return mysqli_real_escape_string($connection, trim($string));
}

function redirect_to($location)
{
    return header("Location:". $location);
}

function users_online()
{
   
        global $connection;

        $session             = session_id();
        $time                = time();
        $time_out_in_seconds = 10;
        $time_out            = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '{$session}' ";
        $send_query = mysqli_query($connection, $query);

        if(!$send_query)
        {
            die("Query Failed". mysqli_error($connection));
        }

        $count_check_users_online = mysqli_num_rows($send_query);

        if($count_check_users_online == null)
        {
            $insert_query = "INSERT INTO users_online(session, time) VALUES('{$session}', {$time}) ";
            mysqli_query($connection, $insert_query);

            if(!$insert_query)
        {
            die("Query Failed". mysqli_error($connection));
        }

        }
        else
        {
            $update_query = "UPDATE users_online SET time = {$time} WHERE session = '{$session}' ";
            mysqli_query($connection, $update_query);

             if(!$update_query)
        {
            die("Query Failed". mysqli_error($connection));
        }

        }

        $select_users_online_query = "SELECT * FROM users_online WHERE time > {$time_out} ";
        $users_online = mysqli_query($connection, $select_users_online_query);

         if(!$users_online)
        {
            die("Query Failed". mysqli_error($connection));
        }

            return $count_users_online = mysqli_num_rows($users_online);


}

function confirm_query($result)
{
    global $connection;
    
    if(!$result)
        {
            die("Query Failed". mysqli_error($connection));
        }
}

function insert_categories()
{
    global $connection;
    
    if(isset($_POST['submit']))

    {                   
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title))

        {
            echo "This field should not be empty";
        }

        else
        {
            $query  = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query)
            {
                die('Query Failed'. mysqli_error($connection));
            }
        }
    }

}

function update_categories()
{
    global $connection;
    
     if(isset($_GET['edit']))
 {
     $cat_id = $_GET['edit'];
     
     include "includes/update_admin_categories.php";
 }

}

function select_all_categories()
{
    global $connection;

    $query = "SELECT * FROM categories ";

    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories))
    {
        $cat_id    = $row['cat_id'];
        $cat_title = $row['cat_title'];

    echo "<tr>";
    echo " <td>$cat_id</td>";
    echo " <td>$cat_title</td>";
    echo " <td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo " <td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";    
    echo "</tr>";
    }

}

function delete_categories()
{
    global $connection;
    
    
    if(isset($_GET['delete']))
    {                 
      $delete_cat_id = $_GET['delete'];

      $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id} ";

      $delete_categories_query = mysqli_query($connection, $query);

      header("Location: categories.php");
    }
}

function recordCount($table)
{
    global $connection;
    

    $query ="SELECT * FROM " . $table;
    $select_count_post = mysqli_query($connection, $query);
    
    $result = mysqli_num_rows($select_count_post);
     
    if (empty($result)) 
    {
        return $result = 0;
    }
    else
    {
        confirm_query($result);
        return $result;
    }
       
         

}

function check_status_post($table, $column_status, $status)
{
    global $connection;
      
    $query ="SELECT * FROM $table WHERE $column_status = '$status' ";
    $select_status_post = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_status_post);
        
    if (empty($result)) 
    {
        return $result = 0;
    }
    else
    {
        confirm_query($result);
        return $result;
    }

}

function check_status_comment($table, $column_comment, $status)
{
    global $connection;
      
    $query ="SELECT * FROM $table WHERE $column_comment = '$status' ";
    $select_status_post = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_status_post);
        
    if (empty($result)) 
    {
        return $result = 0;
    }
    else
    {
        confirm_query($result);
        return $result;
    }

}

function check_user_role($table, $user_role, $status)
{
    global $connection;
      
    $query ="SELECT * FROM $table WHERE $user_role = '$status' ";
    $select_status_post = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_status_post);
        
    if (empty($result)) 
    {
        return $result = 0;
    }
    else
    {
        confirm_query($result);
        return $result;
    }

}

function is_admin($username)
{
    global $connection;
    
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    
    confirm_query($result);
    
    $row = mysqli_fetch_array($result);
    
    if($row['user_role'] == 'admin')
    {
        return true;
    }
    else 
    {
        return false;
    }
            
}

function is_username_exists($username)
{
    global $connection;
    
    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    
    confirm_query($result);
    
    $count_username_exists = mysqli_num_rows($result);
    
    if($count_username_exists > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
        
    
}

function is_user_email_exists($user_email)
{
    global $connection;
    
    $query = "SELECT user_email FROM users WHERE user_email = '$user_email' ";
    $result = mysqli_query($connection, $query);
    
    confirm_query($result);
    
    $count_user_email_exists = mysqli_num_rows($result);
    
    if($count_user_email_exists > 0)
    {
        return true;
    }
    else
    {
        return false;
    }    
}

function register_user($username, $email, $password)
{
    global $connection;
    
//        $shouldRegister = true;
            
//        if(empty($username) && empty($email) && empty($password))
//        {
//             $message = "<script>alert('Any Field Cannot Be Empty')</script>";
//            
//        }
        
//        if(is_username_exists($username))
//        {
//            $message1 = "<h3 class='text-center alert-danger'>Username Exists</h3>";
//            $shouldRegister = false;
//            //return ;
//        }
//       $shouldRegister == true &&           
//        if( !empty($username) && !empty($email) && !empty($password))   
//            
//        {

    $username_cleaned = mysqli_real_escape_string($connection ,$username);
    $email_cleaned    = mysqli_real_escape_string($connection ,$email);
    $password_cleaned = mysqli_real_escape_string($connection ,$password);

    $password_hash = password_hash($password_cleaned, PASSWORD_BCRYPT, array('cost' => 12));    

    //        $query = "SELECT randSalt FROM users ";
    //        $select_randsalt_query = mysqli_query($connection, $query);
    //        
    //        if(!$select_randsalt_query)
    //        {
    //            die("Query Failed". mysqli_error($connection));
    //        }
    //        
    //         $row = mysqli_fetch_array($select_randsalt_query);
    //         $randSalt = $row['randSalt'];
    //            
    //        $crypt_password = crypt($password_cleaned, $randSalt);

    $query  ="INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .="VALUES('{$username_cleaned}', '{$email_cleaned}', '{$password_hash}', 'subscriber') ";

    $register_query = mysqli_query($connection, $query);

    confirm_query($register_query);
    
    redirect_to("registration.php");
//$message = "<h3 class='text-center alert-success'> Registation has been submitted</h3>";
    //    }
}

function login_user($username, $password)
{
    global $connection;
    
    $username = trim($username);
    $password = trim($password);
        
    $username_cleaned = mysqli_real_escape_string($connection, $username);
    $password_cleaned = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username_cleaned}' ";

    $select_user_query = mysqli_query($connection, $query);

    if(!$select_user_query)
    {
        die("Query Failed". mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query))
    {
        $db_user_id         = $row['user_id'];
        $db_username        = $row['username'];
        $db_user_password   = $row['user_password'];
        $db_user_firstname  = $row['user_firstname'];
        $db_user_lastname   = $row['user_lastname'];
        $db_user_role       = $row['user_role'];
    }

    if(password_verify($password_cleaned, $db_user_password))
    {
        $_SESSION['username']       = $db_username;
        $_SESSION['user_password']  = $db_user_password;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname']  = $db_user_lastname;
        $_SESSION['user_role']      = $db_user_role; 

        redirect_to("../admin");
        //header ("Location: ../admin");
    }
//        $crypt_password = crypt($password_cleaned, $db_user_password);
//
//        
//        if($username_cleaned === $db_username && $crypt_password === $db_user_password)
//        {
//            $_SESSION['username']       = $db_username;
//            $_SESSION['user_password']  = $db_user_password;
//            $_SESSION['user_firstname'] = $db_user_firstname;
//            $_SESSION['user_lastname']  = $db_user_lastname;
//            $_SESSION['user_role']      = $db_user_role;
//            
//            header ("Location: ../admin");
//        }
    else
    {
        redirect_to("../index.php");
        //header ("Location: ../index.php");
    } 
}


?>