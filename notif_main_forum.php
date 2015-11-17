<?php
require_once 'core/init.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Notification | Page</title>
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
    <br>
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
        echo "<td width=5% align=center bgcolor=#E6E6E6 data-color='red'><a href=notif_delete.php>Clear</a><br>
                                                        <a href='#' data-toggle='modal' data-target='#assignUser'>Assign users</a>
        </td>";
        echo "</tr>";
    }
    }
    ?>
    </tbody>




</table>
        </div>
    </div>
    <div id="assignUser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Users</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
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
