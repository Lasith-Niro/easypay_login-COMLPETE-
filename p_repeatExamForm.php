<?php

require_once 'core/init.php';
require_once 'browser/browserconnect.php';
require 'Files/accessFile.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Payment | Page</title>
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
$tra = new Transaction();
$fileObject = new accessFile();
$dataArray = $fileObject->read('Files/data_repeatExam');

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

$prefix = 'easyID_';
$lastID = (integer)$tra->lastID();
$newID = $lastID + 1;
$transactionID = $tra->encodeEasyID($prefix, $newID);
//echo $transactionID . '<br />';
$_SESSION['tId'] = $transactionID;

$date1 = strtotime($dataArray[1]);
$date2 = time();
$dayLimit = $date1-$date2;
$dayLimit = floor($dayLimit/(60*60*24));

if($dayLimit<0){
    echo "payment is closed!";
}else {
$uID = $user->data()->id;
$uRegID = $user->data()->regNumber;

if(!$uRegID){
//    echo "You have not submitted your registration number." . '<br />';
    echo "<div class='alert alert-danger'>You have not submitted your registration number.</div>";
} else {
//    echo "Your registration number is " . $uRegID . '<br />';
    echo "<div class='alert alert-info'>Your registration number is $uRegID </div>";
}
//echo "You have to pay Rs.25 per paper." . '<br />';
    echo "<div class='alert alert-info'>You have to pay Rs.25 per paper. </div>";
$de_transactionID = $tra->decodeEasyID($transactionID);
$_SESSION['deID'] = $de_transactionID;

if(Input::exists()) {
    if (Token::check(Input::get('token'))) {
            $semester = Input::get('examSem');
            $index = Input::get('indexNo');
            $init_name = Input::get('initName');
            $full_name = Input::get('fullName');
            $mobilePhone = Input::get('mobileNo');
            $fixedPhone = Input::get('fixedNo');
            $subCode = Input::get('subjectCode');
            $subName = Input::get('subjectName');
            $assignmentComplete = Input::get('assignmentCom');
            $gradeFirst = Input::get('l1Grade');
            $gradeSecond = Input::get('l2Grade');
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
                'paymentStatus' => 0,
                'adminStatus' => 0
            ));
        }
        $_SESSION['num'] = $numForms;
        Redirect::to('p_repeatExam.php');
    } else {
        echo "error";
//        foreach ($validation->errors() as $error) {
//            echo $error, '</ br>';
//        }
    }
}
?>


<form action="" method="post" class="form-horizontal">
    <div id="f1">
        <div>
            <h3>Repeat Exam Form</h3>
        </div>
        <?php
        if((integer)date('m') < 6){
            ?>
            <div class="gap">
                <label>Semester</label>
                <select class="form-control" name="examSem" required="true">
                    <option id="FYS1" value="<?php echo escape("FYS1"); ?>">First year - Semester I</option>
                    <option id="SYS1" value="<?php echo escape("SYS1"); ?>">Second year - Semester I</option>
                    <option id="TYS1" value="<?php echo escape("TYS1"); ?>">Third year - Semester I</option>
                </select>
            </div>
        <?php
        }else{
            ?>
            <div class="gap">
                <label>Semester</label>
                <select class="form-control" name="examSem" required="true" >
                    <option id="FYS2" value="<?php echo escape("FYS2"); ?>">First year - Semester II</option>
                    <option id="SYS2" value="<?php echo escape("SYS2"); ?>">Second year - Semester II</option>
                    <option id="TYS2" value="<?php echo escape("TYS2"); ?>">Third year - Semester II</option>
                </select>
            </div>
        <?php
        }
        ?>
        <div class="gap">
            <label for="indexNo">Index number</label>
            <input class="form-control" type="text" name="indexNo" required="true" value="<?php echo Input::get('indexNo'); ?>">

        </div>
        <div class="gap">
            <label>Name with initials</label>
            <input class="form-control" type="text" name="initName" required="true" value="<?php echo Input::get('initName'); ?>">

        </div>
        <div class="gap">
            <label>Name in full</label>
            <input class="form-control" type="text" name="fullName" required="true" value="<?php echo Input::get('fullName'); ?>">
        </div>
        <h4>Contacts</h4>
        <div class="gap">
            <label>Mobile number</label>
            <input class="form-control" type="tel" name="mobileNo" required="true" value="<?php echo escape($user->data()->phone); ?>">

            <label>Fixed number</label>
            <input class="form-control" type="text" name="fixedNo" required="true" value="<?php echo Input::get('fixedNo'); ?>">
        </div>
        <!--    Subject code + Subject name + Assignment complete + Grades obtained (prev)-->
        <h4>Subject Details</h4>
        <div id="subjectDet" class="gap">
            <div>
                <label>Subject code</label>
                <input class="form-control" type="text" name="subjectCode[]" required="true" value="<?php echo Input::get('subjectCode'); ?>">

                <label>Subject name</label>
                <input class="form-control" type="text" name="subjectName[]" required="true" value="<?php echo Input::get('subjectName'); ?>">

                <div>
                    <label>Assignment Completed?</label>
                    <select class="form-control" name="assignmentCom[]" required="true">
                        <option value="<?php echo "yes"; ?>">Yes</option>
                        <option value="<?php echo "no"; ?>" >No</option>
                    </select>
                </div>
                <div>
                    <div>
                        <h4>Grades Obtained</h4>
                    </div>
                    <div>
                        <label for="firstShy">First attempt</label>
                        <select class="form-control" name="l1Grade[]" value="<?php echo Input::get('l1Grade'); ?>">
                            <option>-</option>
                            <option>C+</option>
                            <option>C</option>
                            <option>C-</option>
                            <option>D+</option>
                            <option>D</option>
                            <option>D-</option>
                            <option>ab</option>
                        </select>
<!--                        <div>-->
<!--                            <input class="form-control" type="text" name="l1Grade[]" required="true" value="--><?php //echo Input::get('l1Grade'); ?><!--">-->
<!--                        </div>-->
                    </div>
                    <div>
                        <label for="secondShy">Second attempt</label>
                        <select class="form-control" name="l2Grade[]" value="<?php echo Input::get('l2Grade'); ?>">
                            <option>-</option>
                            <option>C+</option>
                            <option>C</option>
                            <option>C-</option>
                            <option>D+</option>
                            <option>D</option>
                            <option>D-</option>
                            <option>ab</option>
                        </select>
<!--                        <div>-->
<!--                            <input class="form-control" type="text" name="l2Grade[]" required="true" value="--><?php //echo Input::get('l2Grade'); ?><!--">-->
<!--                        </div>-->
                    </div>
                    <div>
                        <label for="thirdShy">Third attempt</label>
                        <select class="form-control" name="l3Grade[]" value="<?php echo Input::get('l3Grade'); ?>">
                            <option>-</option>
                            <option>C+</option>
                            <option>C</option>
                            <option>C-</option>
                            <option>D+</option>
                            <option>D</option>
                            <option>D-</option>
                            <option>ab</option>

                        </select>
<!--                        <div>-->
<!--                            <input class="form-control" type="text" name="l3Grade[]" required="true" value="--><?php //echo Input::get('l3Grade'); ?><!--">-->
<!--                        </div>-->
                    </div>

                </div>
            </div>
            <br>
        </div>
        <div id="container">

        </div>
        <div>
            <input class="btn btn-default" id="add" name="add" type="button" value="Add Form" onclick="createCopy();">
            <input class="btn btn-default" id="remove" name="remove" type="button" value="remove Form" onclick="removeCopy();">
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input class="btn btn-default" type="submit" value="Next">
    </div>
</form>

</div>
</div>

<?php
}
include "footer.php";
?>

</body>
</html>