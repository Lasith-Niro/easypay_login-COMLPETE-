<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 13/09/15
 * Time: 23:29
 */

/*
     ######    ##     ####    #   #  #####     ##     #   #   ####   #
     #        #  #   #         # #   #    #   #  #     # #   #       #
     #####   #    #   ####      #    #    #  #    #     #     ####   #
     #       ######       #     #    #####   ######     #         #  #
     #       #    #  #    #     #    #       #    #     #    #    #  #
     ######  #    #   ####      #    #       #    #     #     ####   ######
 */
require_once 'core/init.php';
require 'payment/encrypt.php';
require 'Files/accessFile.php';
require_once 'browser/browserconnect.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Payment | Page</title>
        <!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
        <!--    <link href="home/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="css/customCss.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
<body>

<?php
include "header.php";
?>
<div class="container backgroundImg">
    <br>
    <div class="jumbotron col-lg-6 col-lg-offset-3">
<?php

$encryptObject = new encrypt();
$tra = new Transaction();
$fileObject = new accessFile();
$dataArray = $fileObject->read('Files/data_newAcaYear');
$urlObject = $fileObject->read_newLine('Files/URLs');
$user = new User();

$amount = $dataArray[0];

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

$prefix = 'easyID_';
$lastID = (integer)$tra->lastID();
$newID = $lastID + 1;
$transactionID = $tra->encodeEasyID($prefix, $newID);
//echo $transactionID . '<br />';


$merchantCode = 'TESTMERCHANT';
$transactionAmount = $amount;
$returnURL = $urlObject[0];
$Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);

//echo $returnURL;
$tra->createTEMP(array(
    'userID' => $user->data()->id
));

$date1 = strtotime($dataArray[1]);
$date2 = time();
$dayLimit = $date1-$date2;
$dayLimit = floor($dayLimit/(60*60*24));

if($dayLimit<0){
//    echo "payment is closed!";
    echo "<div class='alert alert-danger'>Payment is closed.</div>";
}else {
//    echo "You have {$dayLimit} days for this payment." . '<br />';
    echo "<div class='alert alert-info'>You have {$dayLimit} days for this payment.</div>";
    $uID = $user->data()->id;
    $uRegID = $user->data()->regNumber;

    if(!$uRegID){
//        echo "You have not submitted your registration number." . '<br />';
        echo "<div class='alert alert-danger'>You have not submitted your registration number.</div>";
    //    echo $uRegID . '<br />';
    } else {
//        echo "Your registration number is " . $uRegID . '<br />';
        echo "<div class='alert alert-info'>Your registration number is $uRegID</div>";
    }
//    echo "You have to pay Rs.600 for register." . '<br />';
    echo "<div class='alert alert-info'>You have to pay Rs.600 for register</div>";

    $_SESSION['type'] = 2;
    $acaYear = date("Y");
    $de_transactionID = $tra->decodeEasyID($transactionID);
    //echo $de_transactionID;
    $tra->createNewAcademicYear(array(
        'transactionID' => $de_transactionID,
        'acaYear' => $acaYear,
        'paymentStatus' => 0
    ));

    ?>
    <form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">

        <input class="btn btn-default" type="submit" value="Pay via eZcash">
        <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </form>
    </div>
    </div>
    <?php
    }

include "footer.php";
?>
</body>
</html>