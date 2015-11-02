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

    <title>Payment | Page</title>
<!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
<!--    <link href="home/css/bootstrap.min.css" rel="stylesheet">-->
<!--    <link href="home/css/full-width-pics.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>
<body>
<div>
    <?php
    include "header.php";
    ?>
</div>
<!--    <div id="header">-->
<!--        <header>-->
<!--            <img id="ucscLogo" src="images/ucsc.png" />-->
<!---->
<!--        </header>-->

<!--    </div>-->
<div class="container">
    <div id="HomeForm" class="jumbotron col-lg-6 col-lg-offset-3">
        <h3>Select your Payment</h3>
        <div>
            <a  href="p_UCSCregistration.php">Register to UCSC</a>
            <br><br>
            <a href="p_newAcaYear.php">Register for new Academic year</a>
            <br><br>
            <a href="p_repeatExamForm.php">Pay Repeat Exam Fees</a>
        </div>
    </div>
</div>


<?php
include "footer.php";
?>

</body>
</html>