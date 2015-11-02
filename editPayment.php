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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin | Dashboard</title>
        <link href="css/customCss.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
    </head>
<body>
<div id="wrapper">
    <?php
    include "header.php";
    ?>
</div>
<div class="backgroundImg">


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