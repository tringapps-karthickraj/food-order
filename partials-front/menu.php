<?php include('config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clan Booyah!!!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="navbar">
            <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/newlogo.jfif" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>logout.php">Logout</a>
                    </li> 
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- Navbar Section Ends Here -->