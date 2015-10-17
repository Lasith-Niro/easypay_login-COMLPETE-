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
    <title>Transactions | Month</title>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>

<form action="" method="post">
    <input id="month" name="month" type="number" placeholder="Enter Month"  value="<?php echo Input::get('month')?>">
    <input id="year" name="year" type="number" placeholder="Enter Year"  value="<?php echo Input::get('year')?>">
    <input type="submit" value="Search">
</form>
<a href="admin_transaction_all.php"><button>Back</button></a>
<?php
    if(Input::exists()){
        if($y = Input::get('year')){
            $year = $y;
//            echo "Year: $y<br>";
        }
        if($m = Input::get('month')){
            $month = "$m";
//            echo "Month: $month<br>";
        }
        ?>
<!--    -->
        <div id="mt" class="panel panel-default">
            <div class="panel-heading">
                Monthly Transaction History Table
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <?php
//                        $MonthTra = DB::getInstance()->get('transaction',array('Month(date)','=',$month));
                            $MonthTra = DB::getInstance()->query("SELECT * FROM transaction WHERE MONTH(date) = $month AND YEAR(date) = $year ");
                        //foreach($MonthTra->results() as $res){
                        //    print_r($res);
                        //    echo"<br>";
                        //}
                        if(!$MonthTra->count()){
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
                            foreach($MonthTra->results() as $t){
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
<!--    -->
    <?php
    }
?>

</body>

</html>