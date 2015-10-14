<?php

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


if(Input::exists()) {
    if (Token::check(Input::get('token'))) {

        /////////////////////////// getting form details////////////////////
        $semester   = Input::get('examSem');
        $index      = Input::get('indexNo');
        $init_name  = Input::get('initName');
        $full_name  = Input::get('fullName');
        $mobilePhone = Input::get('mobileNo');
        $fixedPhone = Input::get('fixedNo');
        $subCode = Input::get('subjectCode');
        $subName = Input::get('subjectName');
        $assignmentComplete = Input::get('assignmentCom');
        $gradeFirst = Input::get('l1Grade');
        $gradeSecond= Input::get('l2Grade');
        $gradeThird = Input::get('l3Grade');


////////////////////// creating a associative array for each subject//////////////////
        $numForms = count($subCode);
        for($i = 0;$i<$numForms;$i++){
            $j = $i+1;
            ${"subject$j"} = array(
                'subjectCode'=>$subCode[$i],
                'subjectName'=>$subName[$i],
                'assignmentCom'=>$assignmentComplete[$i],
                'gradeFirst'=>$gradeFirst[$i],
                'gradeSecond'=>$gradeSecond[$i],
                'gradeThird'=>$gradeThird[$i]
            );
        }

//        ////printing subject array///
//        for($i=0;$i<$numForms;$i++){
//            $j=$i+1;
//            print_r(${"subject$j"});
//            echo "<br>";
//        }

        /////////////////////// creating transaction array and insert data////////////////
        for ($i = 0; $i < $numForms; $i++) {
            $j = $i + 1;
            $tra->createRepeatExam(array(
                'transactionID' => $de_transactionID,
                'Year' => $user->data()->year,
                'Semester' => $semester,
                'subjectCode' => ${"subject$j"}['subjectCode'],
                'indexNumber' => $index,
                'nameWithInitials' => $init_name,
                'fullName' => $full_name,
                'fixedPhone' => $fixedPhone,
                'subjectName' => ${"subject$j"}['subjectName'],
                'AssignmentComplete' => ${"subject$j"}['assignmentCom'],
                'gradeFirst' => ${"subject$j"}['gradeFirst'],
                'gradeSecond' => ${"subject$j"}['gradeSecond'],
                'gradeThird' => ${"subject$j"}['gradeThird'],
                'status' => 0
            ));
        }
        Redirect::to('p_repeatExam.php');
    } else {
        foreach ($validation->errors() as $error) {
            echo $error, '</ br>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>repeat | forms</title>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<form action="" method="post">
    <div id="f1">
        <div class="field">
            <label for="intro" >Please select the appropriate exam <br> <br></label>
        </div>
        <?php
        if((integer)date('m') < 6){
            ?>
            <div class="field">
                <select name="examSem" required="true">
                    <option id="FYS1" value="<?php echo escape("FYS1"); ?>">First year - Semester I</option>
                    <option id="SYS1" value="<?php echo escape("SYS1"); ?>">Second year - Semester I</option>
                </select>
            </div>
        <?php
        }else{
            ?>
            <div class="field">
                <select name="examSem" required="true" >
                    <option id="FYS2" value="<?php echo escape("FYS2"); ?>">First year - Semester II</option>
                    <option id="SYS2" value="<?php echo escape("SYS2"); ?>">Second year - Semester II</option>
                </select>
            </div>
        <?php
        }
        ?>
        <div class="field">
            <label for="indexNo">Index number
                <input type="text" name="indexNo" required="true" value="<?php echo Input::get('indexNo'); ?>">
            </label>
        </div>
        <div class="field">
            <label>Name with initials
                <input type="text" name="initName" required="true" value="<?php echo Input::get('initName'); ?>">
            </label>
        </div>
        <div class="field">
            <label>Name in full
                <input type="text" name="fullName" required="true" value="<?php echo Input::get('fullName'); ?>">
            </label>
        </div>
        <br>
        <div class="field">
            <label for="contact">Contacts<br ></label>
            <label>Mobile number
                <input type="text" name="mobileNo" required="true" value="<?php echo escape($user->data()->phone); ?>">
            </label>
            <label>Fixed number
                <input type="text" name="fixedNo" required="true" value="<?php echo Input::get('fixedNo'); ?>">
            </label>
        </div>
        <br>
        <!--    Subject code + Subject name + Assignment complete + Grades obtained (prev)-->
        <div id="subjectDet">
            <div class="field">
                <label for="details">Subject Details <br> </label>
                <label>Subject code
                    <input type="text" name="subjectCode[]" required="true" value="<?php echo Input::get('subjectCode'); ?>">
                </label>
                <label>Subject name
                    <input type="text" name="subjectName[]" required="true" value="<?php echo Input::get('subjectName'); ?>">
                </label>
                <div class="field">
                    <label>Assignment Completed?</label>
                    <select name="assignmentCom[]" required="true">
                        <option value="<?php echo "yes"; ?>">Yes</option>
                        <option value="<?php echo "no"; ?>" >No</option>
                    </select>
                </div>
                <br>
                <div>
                    <div>
                        <label for="gradesObtained">Grades Obtained</label>
                    </div>
                    <div>
                        <label for="firstShy">1</label>
                        <label>
                            <input type="text" name="l1Grade[]" placeholder="-" required="true" value="<?php echo Input::get('l1Grade'); ?>">
                        </label>
                    </div>
                    <div>
                        <label for="secondShy">2</label>
                        <label>
                            <input type="text" name="l2Grade[]" placeholder="-" required="true" value="<?php echo Input::get('l2Grade'); ?>">
                        </label>
                    </div>
                    <div>
                        <label for="thirdShy">3</label>
                        <label>
                            <input type="text" name="l3Grade[]" placeholder="-" required="true" value="<?php echo Input::get('l3Grade'); ?>">
                        </label>
                    </div>

                </div>
            </div>
            <br>
            <br>
        </div>
        <div id="container">

        </div>
        <div>
            <input id="add" name="add" type="button" value="Add Form" onclick="createCopy();">
            <input id="remove" name="remove" type="button" value="remove Form" onclick="removeCopy();">
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Next">
    </div>
</form>

</body>
</html>