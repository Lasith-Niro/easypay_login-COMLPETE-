<?php
require_once 'core/init.php';
//$user = new user();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home | Page</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>


</head>

<body>

<?php
    include 'header.php';

?>
<div class="container">
    <header class="image-bg-fluid-height">
        <img class="img-responsive img-center" src="images/ucsc.png" alt="" width="150px" >
    </header>

    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="section-heading">Easy Pay</h1>
                    <p class="lead section-lead">The easiest way to make payments for UCSC.</p>
                    <p class="section-paragraph">The purpose of the 'Easy-pay' system is to develop and implement an online payment system; “Easy-pay”, which facilitates making online payments without the association of credit cards. The system will collaborate with the renowned mobile payment system Dialog eZ Cash of Dialog Axiata PLC to fulfil this purpose. The Easy-pay system will be initially developed for the students in University of Colombo School of Colombo (UCSC) thus providing a web interface for them to make online payments to the UCSC. A web interface will be developed in order to facilitate making payments. This contains user friendly interfaces that would help students and the university staff to easily interact with the system. Each and every student who gets registered with the system should have a separate profile through which he/she can view their payment history, receive admission cards and the relevant reminders.</p>

                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Height Image Aside -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <aside class="image-bg-fixed-height"></aside>

    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="section-heading">Section Heading</h1> -->
                    <p class="lead section-lead">No more queues! Transaction within seconds!!</p>
                    <p class="section-paragraph">The Easy-pay system is intended to ultimately provide an online payment facility that does not require credit cards. Initially the system will be developed for the undergraduates of the UCSC. The system would collaborate with the mobile payment gateway (eZ Cash) of Dialog Axiata PLC. An agreement shall be signed with Dialog Axiata PLC in order to gain access to their Internet Payment Gateway (IPG). The Easy-pay system should include a database that would enable the storage of following information. Using the information stored, system would generate customized reports, auto generated admission cards and SMS reminders to the students. The PIN issued for the eZ Cash accounts needs to be entered when making a payment through the Easy-pay system. The PIN shall not be saved in the database of the system.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
</div>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; www.easypaysl.com</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<?php
include "footer.php";
?>

</body>
</html>