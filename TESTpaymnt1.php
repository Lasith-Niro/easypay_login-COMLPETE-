<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 10/08/15
 * Time: 19:50
 */

require_once 'core/init.php';


$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'amount' => array(
                'required' => true,
                'min' => 2,
            )
        ));
        if($validation->passed()){
            $amount = Input::get('amount');
            Session::flash('home', 'Your password has been changed.');
//            Redirect::to('payment/ipg.php');
            $transaction = new transaction();
            $transactionID = '0003';
            $merchantCode = "TESTMERACHANT";
            $transactionAmount = $amount;
            $returnURL = 'http://localhost:63342/easypay_login-COMLPETE-/TESTpayment_returnURL.php';
            $str = $transaction->makeTransaction($transactionID, $merchantCode, $transactionAmount, $returnURL);
            $url = 'https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal';
            $transaction->send($url, $str);

        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }


    }
}

$phoneNumber = $user->data()->phone;
$uID = $user->data()->id;

?>

<form action="" method="post">
<!--    <div class="field">-->
<!--        <label for="pin">Enter your ez-cash pin number </label>-->
<!--        <input type="password" name="pin" id="pin">-->
<!--    </div>-->
    <div class="field">
        <label for="amount">Enter your amount </label>
        <input type="text" name="amount" id="amount">
    </div>
    <input type="hidden" value="<%=Invoice%>" name="merchantInvoice">
    <input type="submit" value="Next">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
