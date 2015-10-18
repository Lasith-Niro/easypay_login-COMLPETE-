<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 18/10/15
 * Time: 11:42
 */
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
    $not = new Notification();
    $deleteID = $_SESSION['dID'];
    $not->deleteNotification($deleteID);
    Redirect::to('notif_main_forum.php');
} else {
    Redirect::to('index.php');
}
