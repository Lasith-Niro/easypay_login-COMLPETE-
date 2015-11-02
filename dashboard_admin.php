<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 17/10/15
 * Time: 07:53
 */
?>
<?php
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
    <div class="container col-lg-9">
        <div class="row">
            <div class="col-md-12">
                <h2>Admin Dashboard</h2>
                <h5>Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname']?></h5>
            </div>
        </div>

        <hr />

            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>General</h4>
    <!--                    <a id="a1" onclick="toggleDiv('inG');">Show/Hide</a>-->
                    </div>
                    <div id="inG">
                        <div class="d_icon" >
                            <a href="admin_transaction_all.php">
                                <figure>
                                    <img src="images/transaction.png" height="100">
                                    <figcaption>Transactions</figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="d_icon" >
                            <a href="editPayment.php">
                                <figure>
                                    <img src="images/editPayments.png" height="100">
                                    <figcaption>Update Payment Types</figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="d_icon" >
                            <a href="notif_main_forum.php">
                                <figure>
                                    <img src="images/notification.png" height="100">
                                    <figcaption>Notifications Forum</figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
    <!---->
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Accounts Manager</h4>
    <!--                    <a id="a2" onclick="toggleDiv('inAM');">Show/Hide</a>-->
                    </div>
                    <div id="inAM">
                        <div class="d_icon" >
                            <a href="#">
                                <figure>
                                    <img src="images/searchUser.png" height="100">
                                    <figcaption>Search Users</figcaption>
                                </figure>
                            </a>
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