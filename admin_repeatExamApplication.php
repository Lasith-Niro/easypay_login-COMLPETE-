<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 11/14/2015
 * Time: 6:52 PM
 */
require_once 'core/init.php';

if(!$_SESSION['isLoggedIn']) {
    Redirect::to('index.php');
}
if($_SESSION['student']){
    Redirect::to('dashboard_student.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <?php include 'headerScript.php'?>

</head>
<body>
<div id="wrapper">
    <?php
    include "header.php";
    ?>
</div>
<div class="backgroundImg container-fluid">
    <?php
    include "adminSidebar.php";
    ?>
    <div class="container col-lg-9">
    <br>
        <div id="appTable" class="container col-lg-12">
            <div class="panel panel-default">
                <div class="pannel-heading text-center">
                    <h4>Repeat Exam Applications</h4>
                </div>
                <table class="table table-hover table-striped">

                    <?php
                    $appDet = DB::getInstance()->get('repeat_exam',array('adminStatus','=',0));
                    if(!$appDet->count()){
                    echo 'No transactions';
                    }else{
                    ?>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Index Number</th>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Assignment status</th>
                        <th>Accept/Reject</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $counter = 0;
                    foreach($appDet->results() as $t){
//                                                           print_r($t);
//                                                           echo'<br>';
                        $counter+=1;
                        $id = $t->id;
                        echo"<tr>";
                        echo "<td>".$counter."</td>";
                        echo "<td>".$t->indexNumber."</td>";
                        echo "<td>".$t->subjectCode."</td>";
                        echo "<td>".$t->subjectName."</td>";
                        echo "<td>".$t->AssignmentComplete."</td>";
//                        echo "<td><button><a>".$t->adminStatus."</a></button></td>";
                        echo "<td><a href='admin_repeatExamStatusUpdater.php?id=".$id."&accept=true'><button class='btn btn-primary'>Accept</button></a> <a href='admin_repeatExamStatusUpdater.php?id=".$id."&reject=true'><button class='btn btn-danger'>Reject</button></a></td>";
                        echo "</tr>";
                    }
                    }?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>

</body>
</html>