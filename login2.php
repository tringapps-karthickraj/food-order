<?php
//include('../config/constant.php'); 
include('./config/constant.php');
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if($count==1)
      {
          $row=mysqli_fetch_assoc($res);
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $row['role'];
          if($_SESSION['role'] == 1){
            header('location:'.SITEURL.'admin/index.php');
          }else{
            header('location:'.SITEURL);
          }
          
          $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
           // To check teh user is logged in or not and logout will unset it
          
      }
      else
      {
        $_SESSION['login'] = "<div class='error text-centre'>Username and Password did not match.</div>";
          header('location:'.SITEURL.'login1.php');
      }
        }
        ?>