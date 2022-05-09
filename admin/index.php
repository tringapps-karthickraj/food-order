<?php include('partials/menu.php')?>

<!-- Main Content Section Starts-->
<div class="main-Content">
<div class="wrapper">
    <h1>DASHBOARD</h1>
    <br><br>
    <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
<br><br>
    
    <div class="col-4 text-centre">
        <?php 
            //sql Query
            $sql="SELECT * FROM category";
            //Execute Query
            $res=mysqli_query($conn, $sql);
            //Count Rows
            $count=mysqli_num_rows($res);

        ?>
        <h1><?php echo $count;?></h1>
        <br/>
        Categories
    </div>
    <div class="col-4 text-centre">
        <?php 
            //sql Query
            $sql2="SELECT * FROM food";
            //Execute Query
            $res2=mysqli_query($conn, $sql2);
            //Count Rows
            $count2=mysqli_num_rows($res2);

        ?>
        <h1><?php echo $count2;?></h1>
        <br/>
       Foods
    </div>
    <div class="col-4 text-centre">
        <?php 
            //sql Query
            $sql3="SELECT * FROM tbl_order";
            //Execute Query
            $res3=mysqli_query($conn, $sql3);
            //Count Rows
            $count3=mysqli_num_rows($res3);

        ?>
        <h1><?php echo $count3;?></h1>
        <br/>
        Total Orders
    </div>
    <div class="col-4 text-centre">
        <?php 
        //Create sql query to get the total revuneue generated
        //Aggregate function in sql
        $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
        //Eexcute the query 
        $res4=mysqli_query($conn, $sql4);
        //Get thevalues 
        $row4=mysqli_fetch_assoc($res4);

        //Get the total revenue 
        $total_revenue=$row4['Total'];


        ?>
        <h1>₹<?php echo $total_revenue;?></h1>
        <br/>
       Revenue Generated
    </div>
    <div class="clearfix"></div>
</div>
</div>
<!--Main Content Section Ends-->
<script>
<link rel="stylesheet" href="admin/css/style.css">
</script>
<?php include('partials/footer.php')?>