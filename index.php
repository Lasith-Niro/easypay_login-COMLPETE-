<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */
require_once 'core/init.php';


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
        <li><a href="easyPayment.php">Payment</a></li>
        <li><a href="changephonenumber.php">Change Phone Number</a> </li>
        <li><a href="logout.php">Log out </a></li>
        <link rel="shortcut icon" href="icon/ucsc.ico">
    </ul>
    <div class="row-fluid">
        <div class="col-md-5 col-md-offset-1">
            <h4><span id=tick2>
				</span>&nbsp;|
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
                    window.onload=show2
                    //-->
                </script>
                <?php
                $date = new DateTime();
                echo $date->format('l, F jS, Y');
                ?><h4>
        </div>
    </div>
<?php

    if ($user->hasPermission('admin')) {
        echo '<p> You are an administrator</p>';
    }


} else {
//    echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Home | Page</title>

        <!-- Bootstrap Core CSS -->
        <link href="home/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="home/css/full-width-pics.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >

        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <img id="img" src="images/logo.png" alt="" width="150px" >

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
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Full Width Image Header with Logo -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <header class="image-bg-fluid-height">
        <img class="img-responsive img-center" src="images/ucsc.png" alt="" width="150px" >


    </header>

    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="section-heading">Easy Pay</h1>
                    <p class="lead section-lead">The easiest way to make payments for UCSC.</p>
                    <p class="section-paragraph">The purpose of the 'Easy-pay' system is to develop and implement an online payment system; “Easy-pay”, which facilitates making online payments without the association of credit cards. The system will collaborate with the renowned mobile payment system Dialog eZ Cash of Dialog Axiata PLC to fulfil this purpose. The Easy-pay system will be initially developed for the students in University of Colombo School of Colombo (UCSC) thus providing a web interface for them to make online payments to the UCSC. A web interface will be developed in order to facilitate making payments. This contains user friendly interfaces that would help students and the university staff to easily interact with the system. Each and every student who gets registered with the system should have a separate profile through which he/she can view their payment history, receive admission cards and the relevant reminders.</p>

                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Height Image Aside -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <aside class="image-bg-fixed-height"></aside>

    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="section-heading">Section Heading</h1> -->
                    <p class="lead section-lead">No more queues! Transaction within seconds!!</p>
                    <p class="section-paragraph">The Easy-pay system is intended to ultimately provide an online payment facility that does not require credit cards. Initially the system will be developed for the undergraduates of the UCSC. The system would collaborate with the mobile payment gateway (eZ Cash) of Dialog Axiata PLC. An agreement shall be signed with Dialog Axiata PLC in order to gain access to their Internet Payment Gateway (IPG). The Easy-pay system should include a database that would enable the storage of following information. Using the information stored, system would generate customized reports, auto generated admission cards and SMS reminders to the students. The PIN issued for the eZ Cash accounts needs to be entered when making a payment through the Easy-pay system. The PIN shall not be saved in the database of the system.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; www.easypaysl.com</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    </body>

    </html>

<?php
}
//$userInsert = DB::getInstance()->update('users', 9, array(
//    'fname' => 'updated'
//));
//
//if($userInsert){
//    echo 'ok';
//}