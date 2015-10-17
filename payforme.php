<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 28/09/15
 * Time: 22:27
 */
?>
<?php
require_once 'browser/browserconnect.php';
$ua=getBrowser();
$yourbrowser= $ua['name'];
$temp_var;
if ($yourbrowser=="Google Chrome"){
    $temp_var="css/paymentCSSChrome.css";
}
elseif($yourbrowser=="Mozilla Firefox"){
    $temp_var="css/paymentCSSFirefox.css";
}
elseif($yourbrowser=="Internet Explorer"){
    $temp_var="css/paymentCSSInternetExplorer.css";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Payment | Home</title>
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
                <a href="homePage.php">
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
                        <a href="homePage.php">HOME</a>
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
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div id="header">
        <header>
            <img id="ucscLogo" src="images/ucsc.png" />

        </header>

    </div>
    <div id="HomeForm">
        <SPAN STYLE="color: darkred; font-size: 12pt">* Select your Payment</SPAN>

        <div id="fonts" >

            <a  href="p_UCSCregistration.php">Register to UCSC</a>
            <br><br>
            <a href="p_newAcaYear.php">Register for new Academic year</a>
            <br><br>
            <a href="p_repeatExamForm.php">Pay Repeat Exam Fees</a>


        </div>
    </div>
</div>


</body>
</html>