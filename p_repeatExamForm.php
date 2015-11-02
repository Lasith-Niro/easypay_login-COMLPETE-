<?php

require_once 'core/init.php';
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
    echo "You have not submitted your registration number." . '<br />';
} else {
    echo "Your registration number is " . $uRegID . '<br />';
}
echo "You have to pay Rs.25 per paper." . '<br />';

$de_transactionID = $tra->decodeEasyID($transactionID);
$_SESSION['deID'] = $de_transactionID;

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
            <h3>Please select the appropriate exam</h3>
        </div>
        <?php
        if((integer)date('m') < 6){
            ?>
            <div>
                <select class="form-control" name="examSem" required="true">
                    <option id="FYS1" value="<?php echo escape("FYS1"); ?>">First year - Semester I</option>
                    <option id="SYS1" value="<?php echo escape("SYS1"); ?>">Second year - Semester I</option>
                </select>
            </div>
        <?php
        }else{
            ?>
            <div>
                <select class="form-control" name="examSem" required="true" >
                    <option id="FYS2" value="<?php echo escape("FYS2"); ?>">First year - Semester II</option>
                    <option id="SYS2" value="<?php echo escape("SYS2"); ?>">Second year - Semester II</option>
                </select>
            </div>
        <?php
        }
        ?>
        <div>
            <label for="indexNo">Index number
                <input class="form-control" type="text" name="indexNo" required="true" value="<?php echo Input::get('indexNo'); ?>">
            </label>
        </div>
        <div>
            <label>Name with initials
                <input class="form-control" type="text" name="initName" required="true" value="<?php echo Input::get('initName'); ?>">
            </label>
        </div>
        <div>
            <label>Name in full
                <input class="form-control" type="text" name="fullName" required="true" value="<?php echo Input::get('fullName'); ?>">
            </label>
        </div>
        <div>
            <div>Contacts</div>
            <label>Mobile number
                <input class="form-control" type="text" name="mobileNo" required="true" value="<?php echo escape($user->data()->phone); ?>">
            </label>
            <label>Fixed number
                <input class="form-control" type="text" name="fixedNo" required="true" value="<?php echo Input::get('fixedNo'); ?>">
            </label>
        </div>
        <!--    Subject code + Subject name + Assignment complete + Grades obtained (prev)-->
        <div id="subjectDet">
            <div>
                <div>Subject Details</div>
                <label>Subject code
                    <input class="form-control" type="text" name="subjectCode[]" required="true" value="<?php echo Input::get('subjectCode'); ?>">
                </label>
                <label>Subject name
                    <input class="form-control" type="text" name="subjectName[]" required="true" value="<?php echo Input::get('subjectName'); ?>">
                </label>
                <div>
                    <label>Assignment Completed?</label>
                    <select class="form-control" name="assignmentCom[]" required="true">
                        <option value="<?php echo "yes"; ?>">Yes</option>
                        <option value="<?php echo "no"; ?>" >No</option>
                    </select>
                </div>
                <div>
                    <div>
                        <label for="gradesObtained">Grades Obtained</label>
                    </div>
                    <div>
                        <label for="firstShy">1</label>
                        <label>
                            <input class="form-control" type="text" name="l1Grade[]" placeholder="-" required="true" value="<?php echo Input::get('l1Grade'); ?>">
                        </label>
                    </div>
                    <div>
                        <label for="secondShy">2</label>
                        <label>
                            <input class="form-control" type="text" name="l2Grade[]" placeholder="-" required="true" value="<?php echo Input::get('l2Grade'); ?>">
                        </label>
                    </div>
                    <div>
                        <label for="thirdShy">3</label>
                        <label>
                            <input class="form-control" type="text" name="l3Grade[]" placeholder="-" required="true" value="<?php echo Input::get('l3Grade'); ?>">
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
            <input class="btn btn-default" id="add" name="add" type="button" value="Add Form" onclick="createCopy();">
            <input class="btn btn-default" id="remove" name="remove" type="button" value="remove Form" onclick="removeCopy();">
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input class="btn btn-default" type="submit" value="Next">
    </div>
</form>


<?php
}
include "footer.php";
?>

</body>
</html>