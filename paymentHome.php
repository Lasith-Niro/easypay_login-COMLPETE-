
<?php
require_once 'core/init.php';
require_once 'browser/browserconnect.php';
$ua=getBrowser();
$yourbrowser= $ua['name'];
$temp_var;
if ($yourbrowser=="Google Chrome"){
    $temp_var="css/paymentHomeCSSChrome.css";
}
elseif($yourbrowser=="Mozilla Firefox"){
    $temp_var="css/paymentHomeCSSFirefox.css";
}
elseif($yourbrowser=="Internet Explorer"){
    $temp_var="css/paymentHomeCSSInternetExplorer.css";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment | Page</title>
    <?php include 'headerScript.php'?>
</head>

<body>
<div id="mainWrapper">
    <?php
    include "header.php";
    ?>
    <div class="backgroundImg container-fluid">
        <br>
        <div id="HomeForm" class="jumbotron col-lg-5 col-lg-offset-3">
            <h3>To whom do you want to pay?</h3>
            <div id="fonts" >
                <a href="payforme.php"> Pay for me <br></a>
                <br>
                <a href="payForOther.php"> Pay for other person </a>
            </div>
        </div>
    </div>

</div>


<?php
include "footer.php";
?>

</body>
</html>