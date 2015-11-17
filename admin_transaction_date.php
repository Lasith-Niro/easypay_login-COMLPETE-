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
<div id="page-wrapper" class="container col-lg-9">
    <div id="page-inner">
        <br>

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
                    Transactions on <?php echo $date?>
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
//                                       print_r($t);
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
        <?php
        }
        ?>
<!--             -->
    </div>
</div>
</div>
<?php

include "footer.php";
?>

</body>
</html>