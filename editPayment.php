<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 16/10/15
 * Time: 19:51
 */
require_once 'core/init.php';
require_once 'browser/browserconnect.php';
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


$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
?>
    <br>
    <div class="jumbotron col-lg-3 col-lg-offset-1">
    <ul>
        <p>
            Edit payment details.
        </p>
        <li><a href="edit_UCSCregistration.php">Register to UCSC</a></li>
        <li><a href="edit_newAcaYear.php">Register for new academic year</a></li>
        <li><a href="edit_repeatExam.php">Pay repeat exam fees</a></li>
    </ul>
</div>

<?php
} else {
    Redirect::to('index.php');
}
?>
</div>
<?php
include "footer.php";
?>

</body>
</html>