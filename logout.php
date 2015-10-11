<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */
require_once 'core/init.php';
$user = new User();
$user->logout();
$_SESSION['isLoggedIn']=false;
Redirect::to('index.php');