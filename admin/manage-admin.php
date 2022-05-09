<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="../css/admin.css"> 
<!-- Main Content Section Starts-->
<div class="main-Content">
<div class="wrapper">
    <h1>Manage admin</h1>

<br/><br/>


<?php
    if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];  //Display session MEssage
    unset($_SESSION['add']); //Removing session Message
}
     if(isset($_SESSION['delete']))
     {
     echo $_SESSION['delete'];  
     unset($_SESSION['delete']);
     }
     if(isset($_SESSION['update']))
     {
         echo $_SESSION['update'];
         unset($_SESSION['update']);
    }
    if(isset($_SESSION['user-not-found']))
    {
        echo $_SESSION['user-not-found'];
        unset($_SESSION['user-not-found']);
    }
    if(isset($_SESSION['pwd-not-match']))
    {
        echo $_SESSION['pwd-not-match'];
        unset($_SESSION['pwd-not-match']);
    }
    if(isset($_SESSION['change-pwd']))
    {
        echo $_SESSION['change-pwd'];
        unset($_SESSION['change-pwd']);
    }
?>
<br/><br/><br/>
<!-- Buttton to Add Admin-->
<a href="add-admin.php" class="btn-primary">Add Admin</a>
<br/><br/><br/>

    <table class="tbl-full">
        <tr>
        <th>S.No</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
</tr>
<?php 
//Query to Get all Admin
$sql = "SELECT*FROM admin where role =1";
//Execute the query
$res = mysqli_query($conn, $sql);

//Check whether the query is exucuted or not
if($res==TRUE)
{
    //Count the rows to check whether we have data in database or not.
    $count = mysqli_num_rows($res);//function to get the all rows in database
    
    $sn=1;//Create a variable and Assign value
    //check the num of rows
    if($count>0) 
    {
        //we have the rows in the databse
          while($rows=mysqli_fetch_assoc($res))
          {
              //using while loop to get the al the dasta from the database
              //And while loop will run long as the we have the dasta in database

              //get individual data
              $id=$rows['id'];
              $full_name=$rows['full_name'];
              $username=$rows['username'];

              //Display the values in our table
              ?>
              <tr>
                <td><?php echo $sn++ ;?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
    
</td>  
          </tr>
              <?php
          }
    }
    else
    {
        //we do not the rows in the database
    }

}
?>

    </table>
    
</div>
</div>
<!--Main Content Section Ends-->

<?php include('partials/footer.php'); ?>