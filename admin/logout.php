<?php  
    //include contants.php for Siterul
    include('../config/constant.php');
    //1. Destroy the Session
    session_destroy(); // unset $_session['user']
    //2. Redirect to Login Page
    header('location:'.SITEURL.'login1.php');
?>