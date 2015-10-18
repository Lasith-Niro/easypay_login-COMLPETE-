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

    <!-- Bootstrap Core CSS -->
    <link href="home/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="home/css/full-width-pics.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
	
        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
			<a href="homePage.php"><img id="img" src="images/logo.png" alt="" width="150px" ></a>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			
                <ul class="nav navbar-nav">
					
					<li>
                        <a href="homePage.php">HOME</a>
                    </li>
					<li>
                        <a href="#">UCSC</a>
                    </li>
                    <li>
                        <a href="#">ABOUT</a>
                    </li>
					
                    <li>
                        <a href="#">SERVICES</a>
                    </li>
                    <li>
                        <a href="#">CONTACT</a>
                    </li>
                    <?php
                    if(!isset($_SESSION['isLoggedIn'])|| $_SESSION['isLoggedIn']==false){

                    ?>
                        <li>
                        <a href="login.php">LOGIN</a>
                    </li>
					<li>
                        <a href="register.php">REGISTER</a>
                    </li>
                    <?php
                    }else{
                        ?>
                        <li>
                            <a href="dashboard_student.php">DASHBOARD</a>
                        </li>

                    <?php
                    }
                    ?>

                </ul>
				
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
if(isset($_SESSION['isLoggedIn'])&& $_SESSION['isLoggedIn']==true) {
    ?>
    <div style="color: white;padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
<?php
}
?>


    <!-- Full Width Image Header with Logo -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
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

</body>

</html>
