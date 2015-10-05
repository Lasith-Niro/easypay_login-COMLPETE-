<?php
require_once 'core/init.php';
require_once'myconnection.php';
$user = new user();
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}else{
    if ($user->hasPermission('admin')) {
        $user_type = 'Admin';
    }
    else{
        $user_type = 'Student';
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div id="wrapper">

    <?php

    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >

        <div class="container" >

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">

                    <li>
                        <a href="homePage.php">HOME</a>
                    </li>
                    <li>
                        <a href="#">UCSC</a>
                    </li>
                    <li>
                        <a href="#">ABOUT</a>
                    </li>

                    <li>
                        <a href="paymentHome.php">PAYMENT</a>
                    </li>
                    <li>
                        <a href="#">CONTACT</a>
                    </li>


                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</div>
<div style="color: white;padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="assets/img/find_user.png" class="user-image img-responsive"/>
            </li>
            <li>
                <a class="active-menu"  href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
            </li>
            <li>
                <a href="paymentHome.php"><i class="fa fa-dollar fa-3x"></i> Make a Payment</a>
            </li>
            <li>
                <a href="update.php"><i class="fa fa-book fa-3x"></i> Update Details</a>
            </li>
            <li>
                <a href="changepassword.php"><i class="fa fa-lock fa-3x"></i> Change Password</a>
            </li>
            <li>
                <a href="changephonenumber.php"><i class="fa fa-phone fa-3x"></i> Change Phone Number</a>
            </li>
        </ul>

    </div>

</nav>
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><?php echo $user_type ?>  Dashboard</h2>
                <h5>Welcome <?php echo escape($user->data()->fname)." ".escape($user->data()->lname)?></h5>
            </div>
        </div>

        <hr />

        <div class="col-md-9 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Transaction History Table
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Transaction ID</th>
                                <th>PayerID</th>
                                <th>Payment type</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $user_id = $user->data()->id;;   // store the user id into session
                            $sql = "SELECT * FROM transaction WHERE payerID='$user_id'";
                            $result = mysqli_query($conn,$sql);

                            //echo $user_id;
                            $counter = 0;
                            while($data = mysqli_fetch_assoc($result)){
                                $counter+=1;
                                echo"<tr>";
                                echo "<td>".$counter."</td>";
                                echo "<td>".$data['date']."</td>";
                                echo "<td>".$data['time']."</td>";
                                echo "<td>".$data['transactionID']."</td>";
                                echo "<td>".$data['payerID']."</td>";
                                echo "<td>"."</td>";
                                echo "<td>".$data['statusDescription']."</td>";
                                echo "<td>".$data['amount']."</td>";
                                echo "</tr>";
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- MORRIS CHART SCRIPTS -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>


</body>
</html>