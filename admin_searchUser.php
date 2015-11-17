<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/14/2015
 * Time: 8:13 PM
 */

require_once 'core/init.php';
if(!$_SESSION['isLoggedIn']==true){
    Redirect::to('login.php');
}
if($_SESSION['admin']==false){
    Redirect::to('dashboard_student.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <?php include 'headerScript.php'?>
<!--        dropdown menu styles-->
<!--    <style>-->
<!--        #result{-->
<!--            cursor:pointer;-->
<!--            height:100px;-->
<!--            overflow-y:scroll;-->
<!--        }-->
<!--    </style>-->
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
    <div class="container">
        <br>

<?php



?>

    <div class="jumbotron col-lg-6 col-lg-offset-1">
        <div class="col-lg-6">
            <input class="form-control" type="text" id="search" placeholder="Enter username to search" autocomplete="off" name="search" value="<?php echo Input::get('search')?>" onkeyup="autoSuggest('result','search.php');"  />
            <div>
                <ul id="result" class="nav navbar" ></ul>
            </div>
        </div>
        <div class="col-lg-6">
            <?php
            if(isset($msg)){
                echo "<div class='alert alert-danger'>$msg</div>";
            }
            ?>
        </div>
    </div>
</div>
</div>
<?php
include "footer.php";
?>

</body>
</html>