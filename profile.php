<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */


require_once 'core/init.php';
//require 'PDF/phpToPDF.php';
//echo "profile.php";
$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
    if(Token::check(Input::get('token'))){
    echo $_SESSION['user_name'];
    }
}

//$myurl = 'http://localhost:63342/easypay_login-COMLPETE-/' . basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
//echo $myurl;
//$html = file_get_contents($myurl);
//$pdf_options = array(
//    "source_type" => 'html',
//    "source" => $html,
//    "action" => 'save',
//    "save_directory" => 'my_pdfs',
//    "file_name" => 'my_filename.pdf');
//phptopdf($pdf_options);
?>
    <form action="" method="post">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </form>