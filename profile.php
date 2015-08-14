<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */


require_once 'core/init.php';
require 'PDF/phpToPDF.php';
$userName = $_SESSION['user'];
//echo $username;
if(!$username = Input::get('user')){
    Redirect::to('index.php');
}else{
    $user = new User($username);
    if(!$user->exists()){
        Redirect::to(404);
    }else{
        $data = $user->data();
    }
?>
    <h3><?php echo escape($data->username); ?> </h3>
    <p>First name: <?php echo escape($data->fname); ?> </p>
    <p>Phone number: <?php echo escape($data->phone); ?> </p>
    <?php
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