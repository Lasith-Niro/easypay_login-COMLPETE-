<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 16/10/15
 * Time: 19:51
 */
require_once 'core/init.php';
require_once 'browser/browserconnect.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
?>
<ul>
    <p>
        Edit payment details.
    </p>
    <li><a href="edit_UCSCregistration.php">Register to UCSC</a></li>
    <li><a href="edit_newAcaYear.php">Register for new academic year</a></li>
    <li><a href="edit_repeatExam.php">Pay repeat exam fees</a></li>
</ul>
<?
} else {
    Redirect::to('index.php');
}
?>