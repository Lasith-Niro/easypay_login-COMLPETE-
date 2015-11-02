<?php
require_once 'core/init.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Notification | Page</title>
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
<div class="col-md-9 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Notification Forum</h4>
            <a class="col-lg-offset-9" href="notif_add_topic.php"><strong>Create New Notification</strong></a>
        </div>

<?php


$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
?>
<table class="table table-striped table-bordered table-hover " width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
    <?php
    //$user_id = $_SESSION['userid'];   // get usr id
    $notification = DB::getInstance()->getAll('SELECT *','notification','DESC');
    if(!$notification->count()){
        echo 'No notifications';
    }else{
    ?>
    <thead>
    <tr>
        <th>#</th>
        <th>Topic</th>
        <th>Details</th>
        <th>Date and time</th>
        <th>Settings</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $counter = 0;
    foreach($notification->results() as $t){
//                                    print_r($t);
//                                    echo'<br>';

        $counter+=1;
        echo"<tr>";
        echo "<td width=6% align=center bgcolor=#E6E6E6>".$t->nID."</td>";
        echo "<td width=10% align=center bgcolor=#E6E6E6>".$t->topic."</td>";
        echo "<td width=20% align=center bgcolor=#E6E6E6>".$t->detail."</td>";
        echo "<td width=5% align=center bgcolor=#E6E6E6>".$t->datetime."</td>";
        $_SESSION['dID'] = $t->nID;
        echo "<td width=5% align=center bgcolor=#E6E6E6 data-color='red'><a href=notif_delete.php>Clear</a><BR>
                                                        <a href=notif_assign_users.php>Assign users</a>
        </td>";
        echo "</tr>";
    }
    }
    ?>
    </tbody>




</table>
</div>
    </div>

<?php
} else {
    Redirect::to('index.php');
}

include "footer.php";
?>

</body>
</html>
