<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/28/2015
 * Time: 10:41 AM
 */

require_once 'core/init.php';
?>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="homePage.php"><img id="img" src="images/logo.png" width="150px" ></a>
        </div>
        <div class=" navbar-collapse collapse"  id="navbar" >
            <ul class="nav navbar-nav">
                <li>
                    <a href="homePage.php">HOME</a>
                </li>
                <li>
                    <a href="#">ABOUT</a>
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  LOGOUT</a></li>
            </ul>
<!--            <button style="float: right">-->
<!--                <a href="logout.php" class="btn navbar-btn">LOGOUT</a>-->
<!--            </button>-->
            <?php
            }
            ?>
        </div>
    </div>
</nav>

