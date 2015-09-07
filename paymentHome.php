
<?php
require_once 'browser/browserconnect.php';
	$ua=getBrowser();
	$yourbrowser= $ua['name'];
	$temp_var;
	if ($yourbrowser=="Google Chrome"){
		$temp_var="css/paymentHomeChrome.css";
	}
	elseif($yourbrowser=="Mozilla Firefox"){
		$temp_var="css/loginCSSFirefox.css";
	}
	elseif($yourbrowser=="Internet Explorer"){
		$temp_var="css/loginCSSInternetExplorer.css";
	}
	
	?>


<!DOCTYPE html>
<html lang="en">
<head>
		<header>
            <img id="ucscLogo" src="images/ucsc.png" /> 
			<img id="easypayLogo" src="images/logo.png" />
			
        </header>
    <title>Payment | Home</title>
    <link rel="stylesheet" href=<?php echo $temp_var?> >
</head>
<body>
<div id="mainWrapper">
    
    <div id="loginForm">
        <form action="login.php" method="POST">
          <div id="test" >
		   <a href="www.google.com"> Pay for me <br></a>
		   <br>
		   <br>
		   <a href="www.google.com"> Pay for other person </a>
            
            
            
			</div>
            
            </div>
            

            
        </form>
        

    </div>

</div>
</body>
</html>
