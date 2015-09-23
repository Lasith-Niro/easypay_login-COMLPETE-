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

$encryptObject = new encrypt();
$tra = new Transaction();
$fileObject = new accessFile();
$amountArray = $fileObject->read('Files/amount');
$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

$prefix = 'easyID_';
$lastID = (integer)$tra->lastID();
$newID = $lastID + 1;
$transactionID = $tra->easyID($prefix, $newID);
echo $transactionID;
//$merchantCode = 'TESTMERCHANT';
//$transactionAmount = $amountArray[0];
//$returnURL = 'www.easypaysl.com/ipgResponse.php';
//$Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);
//$tra->createTEMP(array(
//    'userID' => $user->data()->id
//));

$date1 = strtotime('2015-12-19');
$today = time();
$dayLimit = $date1-$today;
$dayLimit = floor($dayLimit/(60*60*24));
echo "You have {$dayLimit} days for this payment." . '<br />';

$uID = $user->data()->id;
$uRegID = $user->data()->regNumber;
if(!$uRegID){
    echo "You have not submitted your registration number." . '<br />';
} else {
    echo "Your registration number is " . $uRegID . '<br />';
}
echo "You have to pay Rs.25 per paper." . '<br />';

$_SESSION['uID'] = $uID;
$_SESSION['reg'] = $uRegID;
$_SESSION['type'] = 2;


?>


<?
/*
 * index number
 * name with initials
 * name in full
 * contact number(mobile + Fixed)
 * Subject code + Subject name + Assignment complete + Grades obtained (prev)
 *
 */

?>

<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">
    <div class="field">
        <label for="intro" >Please tick on the appropriate exam <br> </label>
        <label for="firstYear_sem1">First year - Semester I</label>
        <input type="radio" name="exam" id="FYS1" value="FYS1">
        <label for="firstYear_sem2">First year - Semester II</label>
        <input type="radio" name="exam" id="FYS2" value="FYS2">  <br>
        <label for="secondYear_sem1">Second year - Semester I</label>
        <input type="radio" name="exam" id="SYS1" value="SYS1">
        <label for="secondYear_sem1">Second year - Semester I</label>
        <input type="radio" name="exam" id="SYS2" value="SYS2">
    </div> <br> <br> <br> <br>

    <div class="field">
        <label for="indexNo">Index number</label>
        <input type="text" name="indexNo" value="<?php echo Input::get('indexNo'); ?>">
    </div>
    <div class="field">
        <label for="init_name">Name with initials</label>
        <input type="text" name="init_name" value="<?php echo Input::get('init_name'); ?>">
    </div>
    <div class="field">
        <label for="fullName">Name in full</label>
        <input type="text" name="fullName" value="<?php echo Input::get('fullName'); ?>">
    </div>
    <div class="field">
        <label for="contact">Contacts<br ></label>
        <label for="Mobile number">Mobile number</label>
        <input type="text" name="mobileNo" value="<?php echo escape($user->data()->phone); ?>">
        <label for="Fixed number">Fixed number</label>
        <input type="text" name="fixedNo" value="<?php echo Input::get('fixedNo'); ?>">
    </div>
    <br> <br>

<!--    Subject code + Subject name + Assignment complete + Grades obtained (prev)-->
    <div class="field">
        <label for="details">Details <br> </label>

        <label for="subjectCode">Subject code</label>
        <input type="text" name="subjectCode" value="<?php echo Input::get('subjectCode'); ?>">

        <label for="subjectName">Subject name</label>
        <input type="text" name="subjectName" value="<?php echo Input::get('subjectName'); ?>">

        <div class="field">
        <label for="subjectCode">Assignment Completed?</label><br>
        <label for="firstYear_sem1">Yes</label>
        <input type="radio" name="subjectCode" id="subjectCode" value="<?php echo "yes"; ?>">
        <label for="firstYear_sem1">No</label>
        <input type="radio" name="subjectCode" id="subjectCode" value="<?php echo "no"; ?>">
        </div>

        <label for="gradesObtained">Grades Obtained</label>
        <br>
        <label for="firstShy">1</label>
        <input type="text" name="l1Grade" value="<?php echo Input::get('l1Grade'); ?>">
        <br>
        <label for="secondShy">2</label>
        <input type="text" name="l2Grade" value="<?php echo Input::get('l2Grade'); ?>">
        <br>
        <label for="thirdShy">3</label>
        <input type="text" name="l3Grade" value="<?php echo Input::get('l3Grade'); ?>">

    </div>





    <input type="submit" value="Pay via eZcash">
    <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>