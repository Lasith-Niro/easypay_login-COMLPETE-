<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
?>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
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
        echo "<td width=5% align=center bgcolor=#E6E6E6><a href=notif_delete.php>Clear</a><BR>
                                                        <a href=notif_assign_users.php>Assign users</a>
        </td>";
        echo "</tr>";
    }
    }
    ?>
    </tbody>

    <tr>
        <td colspan="5" align="right" bgcolor="#E6E6E6"><a href="notif_add_topic.php"><strong>Create New Notification</strong> </a></td>
    </tr>

</table>
<?
} else {
    Redirect::to('index.php');
}
?>