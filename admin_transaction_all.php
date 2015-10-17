<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/16/2015
 * Time: 7:53 PM
 */

require_once 'core/init.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transactions | All</title>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<select>
    <option>#</option>
    <option onclick="showElement('at');">All Transactions</option>
    <option onclick="window.location.replace('admin_transaction_month.php');">Monthly Transactions</option>
    <option onclick="window.location.replace('admin_transaction_date.php');">Transactions on specific date</option>
</select>
<a href="dashboard_admin.php"><button>Back to Dashboard</button></a>

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
</body>

</html>