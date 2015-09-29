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

    ?>
    <!--<p>Wellcome <?php //echo escape($user->data()->username) ?></p> -->
    <!--    <p>Hello <a href="profile.php?user=--><?php //echo escape($user->data()->username); ?><!--"> --><?php //echo escape($user->data()->username); ?><!-- </a> ! </p>-->

    <div class="row-fluid">
        <div class="col-md-5 col-md-offset-1">
            <h4><span id=tick2>
				</span>&nbsp;
                <script>
                    function show2(){
                        if (!document.all&&!document.getElementById)
                            return
                        thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
                        var Digital=new Date()
                        var hours=Digital.getHours()
                        var minutes=Digital.getMinutes()
                        var seconds=Digital.getSeconds()
                        var dn="PM"
                        if (hours<12)
                            dn="AM"
                        if (hours>12)
                            hours=hours-12
                        if (hours==0)
                            hours=12
                        if (minutes<=9)
                            minutes="0"+minutes
                        if (seconds<=9)
                            seconds="0"+seconds
                        var ctime=hours+":"+minutes+":"+seconds+" "+dn
                        thelement.innerHTML=ctime
                        setTimeout("show2()",1000)
                    }
                    //window.onload=show2
                    //-->
                </script>
                <?php
                $date = new DateTime();
                //echo $date->format('l, F jS, Y');
                ?><h4>
        </div>
    </div>
    <?php

    if ($user->hasPermission('admin')) {
        $msg= '<p> You logged as an Administrator</p>';
    }
    else{
        $msg= '<p> You logged as a Student </p>';
    }


} else {
//    echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
    include('loginfail.html');
}
//$userInsert = DB::getInstance()->update('users', 9, array(
//    'fname' => 'updated'
//));
//
//if($userInsert){
//    echo 'ok';
//}?>

<?php
$ua=getBrowser();
$yourbrowser= $ua['name'];
$temp_var;
if ($yourbrowser=="Google Chrome"){
    $temp_var="css/indexCSSChrome.css";
}
elseif($yourbrowser=="Mozilla Firefox"){
    $temp_var="css/indexCSSFirefox.css";
}
elseif($yourbrowser=="Internet Explorer"){
    $temp_var="css/payment1CSSInternetExplorer.css";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Welcome to Easypay</title>
    <link rel="stylesheet" href=<?php echo $temp_var?> >
    <link href="home/css/bootstrap.min.css" rel="stylesheet">
    <link href="home/css/full-width-pics.css" rel="stylesheet">


</head>


<body>

<div id="mainWrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >

        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a href="home page.html">
                    <img id="img" src="images/logo.png" alt="" width="150px" >
                </a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">

                    <li>
                        <a href="#">HOME</a>
                    </li>
                    <li>
                        <a href="#">UCSC</a>
                    </li>
                    <li>
                        <a href="#">ABOUT</a>
                    </li>

                    <li>
                        <a href="#">SERVICES</a>
                    </li>
                    <li>
                        <a href="#">CONTACT</a>
                    </li>
                    <li>
                        <a href="login.php">LOGIN</a>
                    </li>
                    <li>
                        <a href="register.php">REGISTER</a>
                    </li>
                    <li>
                        <a href="logout.php"><span id="tab">LOG OUT</span></a>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div id="header">
        <header>
            <img id="ucscLogo" src="images/ucsc.png" />


            <div id="welcomeDes">
                <h2>Welcome <?php echo escape($user->data()->fname)." ".escape($user->data()->lname)?></h2>
                <h3><?php echo $msg ?></h3>
                <?php echo $date->format('l, F jS, Y'); ?>
                <script> window.onload=show2 </script>
            </div>


        </header>

    </div>

    <div id="activityForm">
        <form action="" method="post">
            <div id="color">
                <ul>

                    <li><a href="update.php">Update details</a></li>
                    <li><a href="changepassword.php">Change password</a></li>
                    <li><a href="paymentHome.php">Payment</a></li>
                    <li><a href="changephonenumber.php">Change Phone Number</a> </li>


                </ul>
            </div>
        </form>
    </div>
</div>
<!--<script>
function myFunction() {
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("rePassword").value;
    if (pass1 != pass2) {
        //alert("Passwords Do not match");
        document.getElementById("password").style.borderColor = "#E34234";
        document.getElementById("rePassword").style.borderColor = "#E34234";
    }
    else {
        alert("Passwords Match!!!");
    }
}
myFunction();
</script> -->
</body>
</html>