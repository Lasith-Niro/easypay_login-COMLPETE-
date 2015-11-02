<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/16/2015
 * Time: 12:51 PM
 */

require_once 'core/init.php';

$searchUser = Input::get('searchUser');
$userDet = DB::getInstance();
$userDet->get('users',array('username','=',$searchUser));
$result = $userDet->results()[0];
print_r($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<div>
    <h1><?php echo $searchUser?>'s Profile Details</h1>
</div>
<div id="userDetails">
    <p>User ID:<?php echo "\t".$result->id;?></p>
    <p>Username:<?php echo "\t".$result->username;?></p>
<!--    <p>Password:--><?php //echo "\t".$result->password;?><!--</p>-->
    <p>Registration No:<?php echo "\t".$result->regNumber;?></p>
    <p>First Name:<?php echo "\t".$result->fname;?></p>
    <p>Last Name:<?php echo "\t".$result->lname;?></p>
    <p>NIC No:<?php echo "\t".$result->nic;?></p>
    <p>Mobile No:<?php echo "\t".$result->phone;?></p>
    <p>Date of Birth<?php echo "\t".$result->dob;?></p>
    <p>E-mail:<?php echo "\t".$result->email;?></p>


</div>
</body>

</html>