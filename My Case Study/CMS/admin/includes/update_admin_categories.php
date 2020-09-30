<form action="" method="post">
        <div class="form-group">
           <label for="cat_title"> Edit </label>
                           
<?php

   if(isset($_GET['edit']))
   {
    $cat_id = $_GET['edit'];   

    $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";

    $select_categories_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories_id))
    {
        $cat_id    = $row['cat_id'];
        $cat_title = $row['cat_title']; 
                    
?>
            
<input type="text" class= "form-control" name="cat_title" value="<?php if(isset($cat_title)){echo $cat_title;}?> ">
            
<?php } } ?>
             
<?php // ------- update Query ---------
                            
    if(isset($_POST['update_category']))
        
    {                 
      $update_cat_title = $_POST['cat_title'];

      $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$cat_id} ";

      $update_categories_query = mysqli_query($connection, $query);
        
        if(!$update_categories_query)
        {
            die("Query Failed". mysqli_error($connection));
        }
        else
        {
            header("Location: categories.php");

        }
    }
                            
?>      
                       
                            

       </div>         

            <div class="form-group">
                <input class="btn btn-primary" name="update_category" type="submit" value="Update Category">
            </div>
</form>  