<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 16/10/15
 * Time: 20:00
 */

require_once 'core/init.php';
require_once 'browser/browserconnect.php';
require 'Files/accessFile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UCSC Registration</title>
    <?php include 'headerScript.php'?>
</head>
<body>

<?php
include "header.php";
?>
<div class="backgroundImg container-fluid">
    <br>
    <div class="jumbotron col-lg-5 col-lg-offset-3">
        <?php

$user = new User();
$fObject = new accessFile();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
    $inFile = $fObject->read('Files/data_newAcaYear');
    $inAmount = $inFile[0];
    $inData = $inFile[1];


    if(Input::exists()){
        if(Token::check(Input::get('token'))) {
            $newDate= Input::get('date');
            $newAmount=Input::get('amount');

            $outData = $newAmount . " " . $newDate;
            $fObject->write('Files/data_newAcaYear', $outData);
            Redirect::to('edit_newAcaYear.php'); //refresh the page

        }
    }
?>

<form action="" method="post">
    <div class="field">
        <label>Enter the new date</label>
        <input class="form-control" type="date" name="date" id="date" value="<?php echo($inData)?>">
    </div>

    <div class="field">
        <label>Enter the new amount</label>
        <input class="form-control" type="text" name="amount" id="amount" value="<?php echo($inAmount)?>" >
    </div>

    <input class="btn btn-default" type="submit" value="Save">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
    </div>
</div>
<?php
} else {
    Redirect::to('index.php');
}
include "footer.php";
?>

</body>
</html>
