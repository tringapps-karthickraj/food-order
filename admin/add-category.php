<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Category</h1>

        <br><br>
        <?php 
         if(isset($_SESSION['add']))
         {
             echo $_SESSION['add'];
             unset($_SESSION['add']);
         }
         if(isset($_SESSION['upload']))
         {
             echo $_SESSION['upload'];
             unset($_SESSION['upload']);
         }
        
        ?>

        <!-- Add Category Form Starts-->
        <form action="" method="POST" enctype="multipart/form-data">  <!-- allows us to upload the image in data-->

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>       
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>        
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
</form>
        <!-- Add CAtegory form ends-->

        <?php 
        //Check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo"Clicked";

            //1. Get the value from Category form
            $title=$_POST['title'];

            //for radio input type, we need to check the button is selected or not
            if(isset($_POST['featured']))
            {
                //Get teh value from form

           $featured = $_POST['featured'];
        }
        else
        {
            //Set teh deafault value
            $featured = "No";
        }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            //Check whether the image is selected or nto and set the value for the image name accordingly
            //print_r($_FILES['image']);

            //die();//Break the code here.


            if(isset($_FILES['image']['name']))
            {
                //Upload the image
                //To upload the image we need, source path and destination path
                $image_name = $_FILES['image']['name'];
                //Upload image only if the image is selected
                if($image_name !="")
                {

                //Auto rename the image
                //Get the Extension of our image (jpg, png, gif, etc)e.g. "specialfood1.jpg"
                $ext = end(explode('.', $image_name));

                //Rename the Image
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_category_834.jpg
                
                $source_path = $_FILES['image']['tmp_name'];
                
                $destination_path = "../images/category/".$image_name;
                //Finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //Check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with irror message
                if($upload==false)
                {
                    //Set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    //Redirect to add category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    //Stop the process
                    die();
                }
              } 
            }
            else
            {
                //Dont upload the image and set the image name value as balnk
                $image_name="";
            }

            //2.Create sql query to insert a category into teh databse
            $sql = "INSERT INTO category SET
             title='$title',
             image_name='$image_name',
             featured='$featured',
             active='$active'
             ";
             //3.execute the query abd save in database
             $res = mysqli_query($conn, $sql);
             //4. Check whether the query executed or not and data is added or  not
             if($res==true)
             {
                 //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Scuccessfully. </div>";
                    //Redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
             }
             else
             {
                 //Failed to Add Category
                 $_SESSION['add'] = "<div class='success'>Failed to add Category. </div>";
                    //Redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');

             }


    }
        ?>
</div>
</div>

<?php include('partials/footer.php'); ?>