<?php
require_once 'core/init.php';
if(!$_SESSION['isLoggedIn']) {
    Redirect::to('index.php');
}
if($_SESSION['admin']){
    Redirect::to('dashboard_admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <?php include 'headerScript.php'?>
</head>

<body>
<div id="wrapper">
    <?php
    include "header.php";
    ?>
</div>
<div class="backgroundImg container-fluid">
<!--<div style="color: white;padding: 15px 50px 5px 50px;-->
<!--float: right;-->
<!--font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>-->
<nav class="navbar-default navbar-side col-lg-3" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="images/User.png" class="user-image " height="150px"/>
            </li>
            <li>
                <a class="active-menu"  href="dashboard_student.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
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
<div class="container col-lg-9 " id="page-wrapper" >
    <div class="row">
        <div class="col-md-12">
            <h2>Student Dashboard</h2>
            <h5>Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname']?></h5>
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
                        <?php
                        $user_id = $_SESSION['userid'];   // get usr id
                        $transaction = DB::getInstance()->get('transaction',array('payerID','=',$user_id));
                        if(!$transaction->count()){
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
                            foreach($transaction->results() as $t){
//                                       print_r($t);
//                                       echo'<br>';
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
    </div>
</div>
</div>
<?php
include "footer.php";
?>



</body>
</html>