<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/16/2015
 * Time: 12:51 PM
 */

require_once 'core/init.php';

if(!$_SESSION['isLoggedIn']==true){
    Redirect::to('login.php');
}
if($_SESSION['admin']==false){
    Redirect::to('dashboard_student.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <?php include 'headerScript.php'?>
    <!--        dropdown menu styles-->
    <!--    <style>-->
    <!--        #result{-->
    <!--            cursor:pointer;-->
    <!--            height:100px;-->
    <!--            overflow-y:scroll;-->
    <!--        }-->
    <!--    </style>-->
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
    <div class="container col-lg-8">
        <br>
<?php
$user = new user();
$searchUser = Input::get('searchUser');
$userDet = DB::getInstance();
$userDet->get('users',array('username','=',$searchUser));
$result = $userDet->results()[0];
//print_r($result);


?>
        <div>
            <div class="col-lg-12">
                <h3><?php echo $searchUser?>'s Profile Details</h3>
            </div>

            <div class="col-lg-12" id="userDetails">
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
            <?php
            if($user->data()->username==$searchUser){
                echo "<div class='alert alert-danger col-lg-12'>This is your Username.</div>";
                ?>
                <div class="col-lg-2">
                    <button class="btn btn-primary">Update User</button>
                </div>
            <?php
            }else {
                ?>
                <div class="col-lg-2">
                    <button class="btn btn-danger">De-activate User</button>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary">Update User</button>
                </div>
            <?php
            }
            ?>

        </div>

    </div>
</div>
</body>

</html>