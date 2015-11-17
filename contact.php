<?php
/**
 * Created by PhpStorm.
 * User: Anjana
 * Date: 11/2/2015
 * Time: 1:21 PM
 */

require_once 'core/init.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact | Page</title>
    <?php include 'headerScript.php'?>
</head>
<body>

<?php
include "header.php";
?>
<div class="backgroundImg container-fluid">
<!--<style>-->
<!---->
<!--/*.fm {*/-->
<!--/*    padding-left: 20%;*/-->
<!--/*    padding-top:5%;*/-->
<!--/*}*/-->
<!--/**/-->
<!--</style>-->

<div class="container">
    <br>
    <div class="jumbotron col-lg-6">
    <form class="form-horizontal" id="contact_form" action="" method="POST" enctype="multipart/form-data">

        <label for="name">Your name:</label>
        <div class="gap">
            <input required id="name" class="form-control" name="name" type="text" value="" size="30" />
        </div>

        <label for="email">Your email:</label>
        <div class="gap">
            <input required id="email" class="form-control" name="email" type="email" value="" size="30" />
        </div>

        <label for="message">Your message:</label>
        <div class="gap">
            <textarea required id="message" class="form-control" name="message" rows="7" cols="30"></textarea>
        </div>
        <input class="btn btn-primary" id="submit_button" name="submit" type="submit" value="Send email" />
    </form>
    </div>

<div class="jumbotron col-lg-5 col-lg-offset-1">
    <div class="jb-text">
        <h3><div class="label label-primary">Contact Us </div></h3>
    <h3><strong>'Easy Pay' Payment system</strong></h3>
    <h4>35, Philip Gunawardena Mawatha, Colombo 07, Sri Lanka.</h4>
    <h4>Contact Easypay: 0712364452</h4>
    <h4>Email: easypaysl@gmail.com</h4>
    </div>
</div>
</div>
<!--<div class="col-xs-6 col-md-4">-->
<!--    <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="400" height="443" src="https://maps.google.com/maps?hl=en&q=35 Philip Gunewardena Mawatha, Colombo, Sri Lanka&ie=UTF8&t=roadmap&z=16&iwloc=B&output=embed"><div><small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small></div><div><small><a href="http://www.premiumlinkgenerator.com/">free link generators on premiumlinkgenerator.com</a></small></div></iframe>-->
<!--</div>-->
</div>
<?php
include "footer.php";
?>
</body>
</html>