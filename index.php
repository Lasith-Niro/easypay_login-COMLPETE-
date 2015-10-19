<?
///**
// * Created by PhpStorm.
// * User: Lasith Niroshan
// * Date: 5/23/2015
// * Time: 1:43 PM
// */
//require_once 'core/init.php';
//
//
//if(Session::exists('home')){
//    echo '<p>' . Session::flash('home') . '</p>';
//}
//$user = new User();
//if($user->isLoggedIn()) {
//    $_SESSION['user_name'] = $user->data()->username;
//    include('loginPass.php');
//    if ($user->hasPermission('admin')) {
//        echo '<p> You are an administrator</p>';
//    }
//
//
//} else {
////    echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
//    include('loginfail.html');
//}
////$userInsert = DB::getInstance()->update('users', 9, array(
////    'fname' => 'updated'
////));
////
////if($userInsert){
////    echo 'ok';
////}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */
require_once 'core/init.php';
require_once 'browser/browserconnect.php';


if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();
if($user->isLoggedIn()) {
    $_SESSION['user_name'] = $user->data()->username;
    //check for admin
    if ($user->hasPermission('admin')) {
        $msg= '<p> You logged as an Administrator</p>';
        Redirect::to('dashboard_admin.php');
    }
    else{
        $msg= '<p> You logged as a Student </p>';
        Redirect::to('dashboard_student.php');
    }
} else {
    //include('loginfail.html');
    Redirect::to('homePage.php');
//    Redirect::to('login.php');
}
?>
