<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 18/10/15
 * Time: 11:42
 */
require_once 'core/init.php';

$not = new Notification();

$deleteID = $_SESSION['dID'];
$not->deleteNotification($deleteID);
