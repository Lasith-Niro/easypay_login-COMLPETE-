<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */
require_once 'core/init.php';

//var_dump(Config::get('localhost'));

if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();
if($user->isLoggedIn()) {
    $_SESSION['user_name'] = $user->data()->username;

    ?>
    <p>Wellcome <?php echo escape($user->data()->username) ?></p>
<!--    <p>Hello <a href="profile.php?user=--><?php //echo escape($user->data()->username); ?><!--"> --><?php //echo escape($user->data()->username); ?><!-- </a> ! </p>-->
    <ul>
<!--        <li><a href="profile.php">My profile </a> </li>-->
        <li><a href="update.php">Update details</a></li>
        <li><a href="changepassword.php">Change password</a></li>
        <li><a href="TESTpaymnt1.php">Payment</a></li>
        <li><a href="changephonenumber.php">Change Phone Number</a> </li>
        <li><a href="logout.php">Log out </a></li>
        <link rel="shortcut icon" href="icon/ucsc.ico">

    </ul>

    <?php

    if ($user->hasPermission('admin')) {
        echo '<p> You are an administrator</p>';
    }


} else {
    echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
    ?>
<link rel="shortcut icon" href="icon/ucsc.ico">
<?php
}
//$userInsert = DB::getInstance()->update('users', 9, array(
//    'fname' => 'updated'
//));
//
//if($userInsert){
//    echo 'ok';
//}