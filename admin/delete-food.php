<?php
        //include constants php 
        include('../config/constant.php');

        //echo delete food page;
        if(isset($_GET['id']) && isset($_GET['image_name']))//either use && orAnd
        {
            //Process to delete
            //echo"Process to delete
            //1. Get id and image name
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            //2. Remove the image if avaialabe
            //Chehck whether the image is avaialable or not delte only if available
            if($image_name!="")
            {
                //It has a image and need to remove from folder
                //Get the image tp path
                $path = "../images/food/".$image_name;
                //Remove the image file from folder
                $remove = unlink($path);
                //Check whether the image is removed or not 
                if($remove==false)
                {
                    //failed to remove image
                    $_SESSION['upload']= "<div class ='error'>Failed to Remove Image File. </div>";
                    //Redirect the Manage food
                    header('location:'.SITEURL.'admin/manage-food.php');
                    //Stop the process
                    die();
                }
            }
                //3. Delete food from databse
                $sql = "DELETE FROM food WHERE id=$id";

                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Check whether teh query is exwxuted or not and set the session messhe respectively
                //4. Redirect to manage food with session message
                if($res==true)
                {
                    //Food Deleted
                    $_SESSION['delete']="<div class='success'>Food Deleted successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Failed to delete food
                    $_SESSION['delete']="<div class='error'>Failed to Delete Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');

                }
        }
            else
            {
                //Redirect to manage food page
                //echo"redirect";
                $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
    
?>