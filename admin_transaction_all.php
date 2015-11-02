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
    <title>Transaction | Page</title>
    <link href="css/customCss.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<div id="wrapper">

    <?php
    include "header.php";
    ?>
</div>
<div class="backgroundImg">

<?php
include "adminSidebar.php";
?>

<div id="page-wrapper" class="container col-lg-9" >
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
                    <h4>Select the time range</h4>
                </div>
                <div class="gap ">
                    <select class="form-control">
                        <option>#</option>
                        <option onclick="toggleDiv('at');">All Transactions</option>
                        <option onclick="window.location = 'admin_transaction_month.php'">Monthly Transactions</option>
                        <option onclick="window.location = 'admin_transaction_date.php'">Transactions on specific date</option>
                    </select>
                </div>

<!--                <a href="dashboard_admin.php"><button class="btn btn-default">Back to Dashboard</button></a>-->

                <div id="at" style="display: none">
                    <div  class="panel panel-default">
                        <div class="panel-heading">
                            All Transaction History Table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <?php
                                    $Alltransactions = DB::getInstance()->get('transaction',array(1,'=',1));
                                    //foreach($Alltransactions->results() as $res){
                                    //    print_r($res);
                                    //    echo"<br>";
                                    //}
                                    if(!$Alltransactions->count()){
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
                                    foreach($Alltransactions->results() as $t){
//                                    print_r($t);
//                                    echo'<br>';
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
<!--                All transactions end-->
<!--                monthly transactions end-->
<!--                daily transactions end-->

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