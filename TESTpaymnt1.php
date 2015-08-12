<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 10/08/15
 * Time: 19:50
 */

require_once 'core/init.php';
require 'payment/encrypt.php';
require 'payment/decrypt.php';

$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'pin' => array(
                'required' => true,
                'min' => 4
            ),
            'amount' => array(
                'required' => true,
                'min' => 2,
            )
        ));

        if($validation->passed()){
            Session::flash('home', 'Your password has been changed.');
            Redirect::to('payment/ipg.php');
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }

    }
}
$phoneNumber = $user->data()->phone;
$uID = $user->data()->id;

$transactionID = '0001';
$merchantCode = "TESTMERACHANT";
$transactionAmount = '100.00';
$returnURL = 'http://easypaysl.com/url.php';
$syntax = $merchantCode . "|" . $transactionID . "|" . $transactionAmount . "|" . $returnURL;
echo $syntax;
//$Invoice = new encrypt($merchantCode, $transactionID, $transactionAmount, $returnURL);


//echo $phoneNumber . "<br />";
//echo $uID;
?>

<form action="" method="post">
    <div class="field">
        <label for="pin">Enter your ez-cash pin number </label>
        <input type="password" name="pin" id="pin">
    </div>
    <div class="field">
        <label for="amount">Enter your amount </label>
        <input type="text" name="amount" id="amount">
    </div>
    <input type="hidden" value="<%=Invoice%>" name="merchantInvoice">
    <input type="submit" value="Next">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
