<?php 
//include Constant file
include('../config/constant.php');

  //echo"Delete page";  
  //Check whether the id and image name value is set or not
  if(isset($_GET['id']) AND isset($_GET['image_name']))
  {
      //Get the value and Delete
      //echo"Get value and Deleted";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name !="")
        {
            //image is available, so remove it
            $path="../images/category/".$image_name;
            //Remove the image 
            $remove = unlink($path);
                
            //If failed to remove image then add an error message adn stop the process
            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove']="<div class='error'>Failed to Remove Category image. </div>";
                //Redirect to manage cateogory page 
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }
        
        // delete data from the databse 
        //Sql Query too delete the data from the database
        $sql = "DELETE FROM category WHERE id=$id";

        //Exeucte the query 
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from teh database or not 
        if($res==true)
        {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted successfully.</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set failed message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        //Redirect to manage category page with message
  }
  else
  {
      //Redirect to Manage Category Page
      header('location:'.SITEURL.'admin/manage-category.php');
  }

  
  ?>