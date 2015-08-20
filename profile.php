<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */


require_once 'core/init.php';
//require 'PDF/phpToPDF.php';
echo "profile.php";
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Token::check(Input::get('token'))){
        echo "sdsd";
//        $name = $user->data()->fname;
//        echo '$name';
    ?>
    <!--    <h3>--><?php //echo escape($user->$data->username); ?><!-- </h3>-->
    <!--    <p>First name: --><?php //echo escape($user->$data->fname); ?><!-- </p>-->
    <!--    <p>Phone number: --><?php //echo escape($user->$data->phone); ?><!-- </p>-->
    <!--        <input type="hidden" name="token" value="--><?php //echo Token::generate(); ?><!--">-->
    <!--    --><?php
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
    <form action="" method="post" xmlns="http://www.w3.org/1999/html">
        <input type="hidden" name="token" value="--><?php echo Token::generate(); ?>
    </form>