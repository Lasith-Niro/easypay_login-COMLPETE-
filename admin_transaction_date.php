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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <link href="css/stdCSS.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<div id="wrapper">
    <?php
    include "header.php";
    ?>
</div>

<?php
include "adminSidebar.php";
?>
<div id="page-wrapper" class="container col-lg-9">
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
                <form action="" method="post" class="form-horizontal">
                    <input class="form-control" id="date" name="date" type="number" placeholder="Enter Date"  required value="<?php echo Input::get('date') ?>">
                    <input class="form-control" id="month" name="month" type="number" placeholder="Enter Month" required   value="<?php echo Input::get('month')?>">
                    <input class="form-control" id="year" name="year" type="number" placeholder="Enter Year" required  value="<?php echo Input::get('year')?>">
                    <input class="btn btn-default" type="submit" value="Search">
                </form>
                <a href="admin_transaction_all.php"><button class="btn btn-default">Back</button></a>
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


<?php
}

include "footer.php";
?>

</body>
</html>