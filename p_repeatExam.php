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
require_once 'browser/browserconnect.php';
require 'Files/accessFile.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Payment | Page</title>
        <!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
        <!--    <link href="home/css/bootstrap.min.css" rel="stylesheet">-->
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
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
<div class="container">
    <div class="jumbotron col-lg-6 col-lg-offset-3">
<?php

//echo "The 2 digit representation of current month with leading zero is: " . date("m") . '<br />';

$encryptObject = new encrypt();
$tra = new Transaction();
$fileObject = new accessFile();
$dataArray = $fileObject->read('Files/data_repeatExam');
$urlArray = $fileObject->read_newLine('Files/URLs');
$user = new User();

$oneAmount = $dataArray[0];
$time = $_SESSION['num'];

$amount= $oneAmount * $time;

//echo $amount;
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

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
//    echo "You have to pay Rs.20.00 to this payment.";
    echo "<div class='alert alert-info'>You have to pay Rs.20.00 to this payment.</div>";
    $prefix = 'easyID_';
    $lastID = (integer)$tra->lastID();
    $newID = $lastID + 1;
    $transactionID = $tra->encodeEasyID($prefix, $newID);
    //$transactionID = $_SESSION['deID'];
//    echo $transactionID . '<br />';

    $merchantCode = 'TESTMERCHANT';
    $transactionAmount = $amount;
    $returnURL = $urlArray[0];
    $Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);

    $tra->createTEMP(array(
        'userID' => $user->data()->id
    ));



    //$_SESSION['uID'] = $uID;
    //$_SESSION['reg'] = $uRegID;
    $_SESSION['type'] = 3;
    ?>

    <form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">
        <input class="btn btn-default" type="submit" value="Pay via eZcash">
        <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </form>
<?php
}

        include "footer.php";
        ?>

</body>
</html>