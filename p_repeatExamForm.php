<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 28/09/15
 * Time: 22:44
 */

require_once 'core/init.php';
require_once 'browser/browserconnect.php';

$user = new User();
$tra = new Transaction();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

$prefix = 'easyID_';
$lastID = (integer)$tra->lastID();
$newID = $lastID + 1;
$transactionID = $tra->encodeEasyID($prefix, $newID);
echo $transactionID . '<br />';
$_SESSION['tId'] = $transactionID;

$date1 = strtotime('2015-12-19');
$today = time();
$dayLimit = $date1-$today;
$dayLimit = floor($dayLimit/(60*60*24));
echo "You have {$dayLimit} days for this payment." . '<br /> <br /> <br />';

$uID = $user->data()->id;
$uRegID = $user->data()->regNumber;

if(!$uRegID){
    echo "You have not submitted your registration number." . '<br />';
} else {
    echo "Your registration number is " . $uRegID . '<br />';
}
echo "You have to pay Rs.25 per paper." . '<br /> <br /> <br />';

$de_transactionID = $tra->decodeEasyID($transactionID);

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
            $semester   = Input::get('examSem');
            $index      = Input::get('indexNo');
            $init_name  = Input::get('initName');
            $full_name  = Input::get('fullName');
            $fixedPhone = Input::get('fixedNo');
            $subCode    = Input::get('subjectCode');
            $subName    = Input::get('subjectName');
            $assignmentComplete = Input::get('assignmentCom');
            $gradeFirst = Input::get('l1Grade');
            $gradeSecond= Input::get('l2Grade');
            $gradeThird = Input::get('l3Grade');

            $tra->createRepeatExam(array(
                'transactionID'=> $de_transactionID,
                'Year' => $user->data()->year,
                'Semester' => $semester,
                'subjectCode' => $subCode,
                'indexNumber' => $index,
                'nameWithInitials' => $init_name,
                'fullName' => $full_name,
                'fixedPhone' => $fixedPhone,
                'subjectName' => $subName,
                'AssignmentComplete' => $assignmentComplete,
                'gradeFirst' => $gradeFirst,
                'gradeSecond' => $gradeSecond,
                'gradeThird' => $gradeThird,
                'status' => 0
            ));
            Redirect::to('p_repeatExam.php');
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '</ br>';
            }
        }
}

/*
 * index number
 * name with initials
 * name in full
 * contact number(mobile + Fixed)
 * Subject code + Subject name + Assignment complete + Grades obtained (prev)
 *
 */

?>


<form action="" method="post">
    <div class="field">
        <label for="intro" >Please tick on the appropriate exam <br> <br></label>
    </div>

    <?php
    if((integer)date('m') < 6){
        ?>
        <div class="field">
            <label for="firstYear_sem1">First year - Semester I</label>
            <label for="FYS1"></label><input type="radio" name="examSem" id="FYS1" value="<?php echo escape("FYS1"); ?>">
            <label for="secondYear_sem1">Second year - Semester I</label>
            <label for="SYS1"></label><input type="radio" name="examSem" id="SYS1" value="<?php echo escape("SYS1"); ?>">
        </div>
    <?
    } else {
        ?>
        <div class="field">
            <label for="firstYear_sem2">First year - Semester II</label>
            <label for="FYS2"></label><input type="radio" name="examSem" id="FYS2" value="<?php echo escape("FYS2"); ?>">

            <label for="secondYear_sem1">Second year - Semester II</label>
            <label for="SYS2"></label><input type="radio" name="examSem" id="SYS2" value="<?php echo escape("SYS2"); ?>">
        </div>
    <?}
    ?>
    <div class="field">
        <label for="indexNo">Index number</label>
        <label>
            <input type="text" name="indexNo" value="<?php echo Input::get('indexNo'); ?>">
        </label>
    </div>
    <div class="field">
        <label for="init_name">Name with initials</label>
        <label>
            <input type="text" name="initName" value="<?php echo Input::get('initName'); ?>">
        </label>
    </div>
    <div class="field">
        <label for="fullName">Name in full</label>
        <label>
            <input type="text" name="fullName" value="<?php echo Input::get('fullName'); ?>">
        </label>
    </div>
    <br>
    <div class="field">
        <label for="contact">Contacts<br ></label>
        <label for="Mobile number">Mobile number</label>
        <label>
            <input type="text" name="mobileNo" value="<?php echo escape($user->data()->phone); ?>">
        </label>
        <label for="Fixed number">Fixed number</label>
        <label>
            <input type="text" name="fixedNo" value="<?php echo Input::get('fixedNo'); ?>">
        </label>
    </div>
    <br>
    <!--    Subject code + Subject name + Assignment complete + Grades obtained (prev)-->
    <div class="field">
        <label for="details">Details <br> </label>
        <label for="subIndex" >1</label> <br>
        <hr>
        <label for="subjectCode">Subject code</label>
        <label>
            <input type="text" name="subjectCode" value="<?php echo Input::get('subjectCode'); ?>">
        </label>

        <label for="subjectName">Subject name</label>
        <label>
            <input type="text" name="subjectName" value="<?php echo Input::get('subjectName'); ?>">
        </label>

        <div class="field">
            <label for="subjectCode">Assignment Completed?</label>
            <label for="Assignment_Completed_Yes">Yes</label>
            <input type="radio" name="assignmentCom" id="assignmentCom" value="<?php echo "yes"; ?>">
            <label for="Assignment_Completed_No">No</label>
            <input type="radio" name="assignmentCom" id="assignmentCom" value="<?php echo "no"; ?>">
        </div>
        <br>
        <div>
            <label for="gradesObtained">Grades Obtained</label>
            <br>
            <label for="firstShy">1</label>
            <label>
                <input type="text" name="l1Grade" placeholder="-" value="<?php echo Input::get('l1Grade'); ?>">
            </label>
            <br>
            <label for="secondShy">2</label>
            <label>
                <input type="text" name="l2Grade" placeholder="-" value="<?php echo Input::get('l2Grade'); ?>">
            </label>
            <br>
            <label for="thirdShy">3</label>
            <label>
                <input type="text" name="l3Grade" placeholder="-" value="<?php echo Input::get('l3Grade'); ?>">
            </label>
        </div>
    </div>

<input type="submit" value="next">
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>