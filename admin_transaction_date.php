<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/16/2015
 * Time: 7:53 PM
 */

require_once 'core/init.php';
if(!$_SESSION['isLoggedIn']) {
    Redirect::to('index.php');
}
if($_SESSION['student']){
    Redirect::to('dashboard_student.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Dashboard</title>
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
    <link href="css/stdCSS.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
        <div class="container" >
            <a href="homePage.php">
                <img id="img" src="images/logo.png" alt="" width="150px" >
            </a>
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
                <img src="images/admin.jpg" class="user-image img-responsive"/>
            </li>
            <li>
                <a class="active-menu"  href="dashboard_admin.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-search fa-3x"></i>Search Student</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-3x"></i>#</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-lock fa-3x"></i>#</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-phone fa-3x"></i>#</a>
            </li>
        </ul>

    </div>

</nav>
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Admin Dashboard</h2>
            </div>
        </div>

        <hr />

        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Enter the date</h4>
                </div>
<!--                -->
                <form action="" method="post">
                    <input id="date" name="date" type="number" placeholder="Enter Date"    value="<?php echo Input::get('date') ?>">
                    <input id="month" name="month" type="number" placeholder="Enter Month"   value="<?php echo Input::get('month')?>">
                    <input id="year" name="year" type="number" placeholder="Enter Year"   value="<?php echo Input::get('year')?>">
                    <input type="submit" value="Search">
                </form>
                <a href="admin_transaction_all.php"><button>Back</button></a>
                <?php
                if(Input::exists()){
                if($y = Input::get('year')){
//        echo "Year: $y<br>";
                }
                if($m = Input::get('month')){
                    $month = "$m";
//        echo "Month: $month<br>";
//        echo "<script type='text/javascript'src='js/functions.js'> showElement('mt')</script>";
                }
                if($d = Input::get('date')){
//            echo $date;
                    $date = "$y-$m-$d";
//        echo "Date: $date<br>";
                }
                ?>
                <!--    -->
                <div id="mt" class="panel panel-default">
                    <div class="panel-heading">
                        Transactions on <?php echo $date?> History Table
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <?php
                                $DayTra = DB::getInstance()->get('transaction',array('date','=',$date));
                                //foreach($MonthTra->results() as $res){
                                //    print_r($res);
                                //    echo"<br>";
                                //}
                                if(!$DayTra->count()){
                                    echo 'No transactions';
                                }else{
                                ?>
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
                                $counter = 0;
                                foreach($DayTra->results() as $t){
//                                        print_r($t);
//                                        echo'<br>';
                                    $counter+=1;
                                    echo"<tr>";
                                    echo "<td>".$counter."</td>";
                                    echo "<td>".$t->date."</td>";
                                    echo "<td>".$t->time."</td>";
                                    echo "<td>".$t->transactionID."</td>";
                                    echo "<td>".$t->payerID."</td>";
                                    echo "<td>".$t->paymentType."</td>";
                                    echo "<td>".$t->statusDescription."</td>";
                                    echo "<td>".$t->amount."</td>";
                                    echo "</tr>";
                                }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

<!--             -->
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
<!---->

</body>

</html>









<!---->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transactions | Date</title>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>

    <!--    -->
<?php
}
?>
</body>

</html>