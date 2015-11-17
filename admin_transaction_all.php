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
    <title>Transaction | Page</title>
    <?php include 'headerScript.php'?>
</head>

<body>
<div id="wrapper">

    <?php
    include "header.php";
    ?>
</div>
<div class="backgroundImg container-fluid">

<?php
include "adminSidebar.php";
?>

<div id="page-wrapper" class="container col-lg-9" >
    <div id="page-inner">
        <br>
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Select the time range</h4>
                </div>
                <div>
                    <a data-toggle="modal" data-target="#at"><button class="btn btn-default">All Transactions</button></a>
                    <a data-toggle="modal" data-target="#mtform"><button class="btn btn-default">Monthly</button></a>
                    <a data-toggle="modal" data-target="#dtform"><button class="btn btn-default">Spacific Date</button></a>

                </div>
<!--                <a href="dashboard_admin.php"><button class="btn btn-default">Back to Dashboard</button></a>-->

                <div id="at" class="modal fade" role="dialog">
                    <div class="modal-dialog">
<!--                        -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">All transaction history</h3>
                            </div>
                            <div class="modal-body">
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
            //                                   print_r($t);
            //                                   echo'<br>';
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
<!--                All transactions end-->
            <div id="mtform" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Enter Month & Year</h3>
                        </div>
                        <div class="modal-body">
                            <form action="admin_transaction_month.php" method="post" class="form-horizontal">
                                <div class="gap">
                                    <div class="col-lg-3">
                                        <input class="form-control" id="month" name="month" type="number" placeholder="Enter Month"  required value="<?php echo Input::get('month')?>">
                                    </div>

                                    <div class="col-lg-3">
                                        <input class="form-control" id="year" name="year" type="number" placeholder="Enter Year" required value="<?php echo Input::get('year')?>">
                                    </div>

                                </div>

                                <div class="gap">
                                    <input class="btn btn-default" type="submit"  value="Search">
<!--                                    <a data-toggle="modal" data-target="#mt"><button class="btn btn-default">Open</button></a>-->
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
<!--                monthly transactions end-->
                <div id="dtform" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Enter Date, Month & Year</h3>
                            </div>
                            <div class="modal-body">
                                <form action="admin_transaction_date.php" method="post" class="form-horizontal">
                                    <div class="col-lg-3 ">
                                        <input class="form-control" id="date" name="date" type="number" placeholder="Enter Date"  required value="<?php echo Input::get('date') ?>">
                                    </div>
                                    <div class="col-lg-3 ">
                                        <input class="form-control" id="month" name="month" type="number" placeholder="Enter Month" required   value="<?php echo Input::get('month')?>">
                                    </div>
                                    <div class="col-lg-3 ">
                                        <input class="form-control" id="year" name="year" type="number" placeholder="Enter Year" required  value="<?php echo Input::get('year')?>">
                                    </div>
                                    <div class="gap">
                                        <input class="btn btn-default" type="submit" value="Search">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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