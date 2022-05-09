<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td>
            <input type="text" name="title" placeholder="Title of the food">
            </td>
        </tr>
            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                </td>
            </tr>
            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>
            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                        <?php 
                        //Create php code to display categories from database
                        //1. create sql to get the all active categories from database
                        $sql = "SELECT * FROM category WHERE active='Yes'";
                        //Executing the query
                        $res= mysqli_query($conn, $sql);
                        //Count rows to check whether we have categories or not
                        $count =mysqli_num_rows($res);
                        //If count is greater than o, we have categories else we do not have categories
                        if($count>0)
                        {
                            //We have categories
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get the details of categories
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?> </option>
                                <?php
                            }
                        }
                        else
                        {
                            //We do nto have categories
                            ?>
                            <option value="0">No category Found</option>
                            <?php
                        }
                        
                   
                        //2. Display on dropbox
                        
                        ?>
                    
                        </select>
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

        </table>

        </form>
            <?php 
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the food in database
                //echo"Clicked";
                //1. Get the data from home
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                //Check whether the radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";//Setting teh default value
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                
                }
                else
                {
                    $active = "No";//Setting default value
                }

                //2. Upload the image if selected
                //Check whether tje select image is clicked or nto and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the deatils of the selected image
                    $image_name=$_FILES['image']['name'];

                    //Check whethr the image is selected ot not and upload image only if selected
                    if($image_name !="")
                    {
                        //Image is selected
                        //A. rename the Image
                        //Get the extension of selected image(jpg, png, gif, etc.)"Poorni-mj.jpg"poorni-mj.jpg
                        $ext = end(explode('.', $image_name));
                        //create new name for image
                        $image_name="Food-Name-".rand(0000,9999).".".$ext;//New iamge may be :food-name-657.jpg"
                        //B. Upload the image
                        //get the src path and destination path

                        //Source path is teh current location of tha image
                        $src = $_FILES['image']['tmp_name'];
                        //Destination path fpr the image to be uploaded
                        $dst = "../images/food/".$image_name;
                        //Finally upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //Check whether the image is uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload the image
                            //Redirect to add food page with error message
                            $_SESSION['upload']="<div class='error'>Failed to upload the image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //Stop the process
                            die();  
                        }
                    }
                }

                //3. Insert into dastabse
                //Create a swl query to save or add food
                //For numerical we do not need to pass te value inside the quotes'' but for string value it is compulsory to add quotes''
                $sql2= "INSERT INTO food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category, 
                featured='$featured',
                active='$active'
                ";
                    //Execute the   query
                    $res2=mysqli_query($conn, $sql2);
                    //Check whether data is inserted or not
                //4. Redirect with Message to manage food page
                 if($res2 == true)
                 {
                     //Data inserted successfully
                     $_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
                     header('location: '.SITEURL.'admin/manage-food.php');
                 }
                 else
                 {
                     //Failed to insert data
                     $_SESSION['add']="<div class='error'>Failed to Add Food..</div>";
                     header('location: '.SITEURL.'admin/manage-food.php');
                 }
            }
            ?>


</div>
</div>


<?php include('partials/footer.php'); ?>