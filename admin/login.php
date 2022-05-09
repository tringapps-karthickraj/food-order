<?php include('../config/constant.php'); ?>


<html>
<head>

    <title>Login</title>
     <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head> 
<body>
  
<div class="container">
    <div class="background">
        <div class="login">
                <h1 class="text-centre">Login</h1><br>
                    <br><br>
                    <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']); 
                    }
                    ?>
                    <br><br>

                        <!-- Login Form Starts Here-->
        <form action="" method="POST" class="text-centre">
            Username:
           <div> <input type="text" name="username" placeholder="Enter Username"></div>
            Password:
            <div><input type="password" name="password" placeholder="Enter Password"></div>

            <input type="submit" name="submit" value="Login" class="btn-primary">

            
    
        </form>
                    <!--Login form Ends Here-->

            <br>
     </div>
    </div>
</div>

</body>
</html>

<?php
  //Check whether the submit Button is Clicked or Not
  if(isset($_POST['submit']))
  {
      echo $username = $_POST['username'];
      echo $password = md5($_POST['password']);
      $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if($count==1)
      {
          $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
          $_SESSION['user'] = $username; // To check teh user is logged in or not and logout will unset it
          header('location:'.SITEURL.'admin/');
      }
      else
      {
        $_SESSION['login'] = "<div class='error text-centre'>Username and Password did not match.</div>";
          header('location:'.SITEURL.'admin/login.php');
      }
  }
  ?>