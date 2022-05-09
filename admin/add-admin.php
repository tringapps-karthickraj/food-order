<?php  include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
</br></br></br>
<?php
if(isset($_SESSION['add']))  //Checking whether the session is set or not
{
echo $_SESSION['add'];  //Display the session message is set or not
unset($_SESSION['add']); //Remove session message
} 
?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                </td>
                </tr>

                <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Your username">
                            </td> 

                </tr>
                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Your password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name ="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                    </table>
</form>
</div>
</div>

<?php include('partials/footer.php');?>

<?php
        //Process the value from form and Save in the Database
        //Check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //Button Clicked
            //echo"Button Clicked";

            //1: Get the Date from here
           $full_name = $_POST['full_name'];
           $username = $_POST['username'];
           $password = md5($_POST['password']);//Password encryption with md5

           //2: SQL Query to save the data into database
            $sql= "Insert INTO admin SET
                full_name='$full_name',
                username='$username',
                password='$password',
                role=1
                ";

                //3. Executing Query and Saving Data into Databse
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

                //4. Check whether the (Query us executed ) dsata is instered or not and display appropriate message
                if($res==TRUE)
                {
                    //Data Inserted
                   // echo"Data Insterted";
                   //Create a session variable to Display Message
                   $_SESSION['add'] = "Admin Added Successfully";
                   //Redirect Page to manage admin
                   header("location:".SITEURL.'admin/manage-admin.php');
                }
                else{
                    //Failed to Insert Data
                   // echo"Failed to Insert Data";
                   //Create a session variable to Display Message
                   $_SESSION['add'] = "Failed to Add Admin";
                   //Redirect Page to manage admin
                   header("location:".SITEURL.'admin/manage-admin.php');

                }
        }
        
        ?> 