<?php 
        //include the constant.php file here 
        include('../config/constant.php');

        //1.get the id of Admin to be deleted
        $id = $_GET['id'];
        //2.Create the sql Query to Delete Admin
        $sql = "DELETE FROM admin WHERE id=$id"; //$id is the one which we get in the get method and id is from the table
        
        //Execute the query
        $res = mysqli_query($conn, $sql);
        
        //Check whether the query is executed is successfully or not
        if($res==TRUE)
        {
         
           //Query executed sucessfully and Admin Deleted
           //echo"Admin Deleted";
           //Create session variable to display message 
           $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
           //Redirect to maanage admin page
           header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            //FAiled to DElete the Admin
            //echo"Failed to Delete Admin";

            $_SESSION['delete'] = "<div class='error'>Failed to delete the admin. Try again later.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

              
        //3.Redirect to manage the ADmin page with message (Success /error)



?>