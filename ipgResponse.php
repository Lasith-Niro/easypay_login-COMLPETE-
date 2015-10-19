<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro with surangi-edirisinghe
 * Date: 26/08/15
 * Time: 09:10
 */

require_once 'core/init.php';
require 'payment/decrypt.php';

/*
 * transaction type codes
 * 1 : UCSC registration fee
 * 2 : New academic year fee
 * 3 : Repeat exam fee
 */
$user = new User();
$dec = new decrypt();
$transaction = new Transaction();

$encrypted = $_POST['merchantReciept'];
$decryptObject = $dec->decode($encrypted);
$decArray = explode('|',$decryptObject);

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//Declare and assign values to variables
//data from ezcash server
$transactionID     = $decArray[0];
$statusCode        = $decArray[1];
$statusDescription = $decArray[2];
$transactionAmount = $decArray[3];
$merchantCode      = $decArray[4];
$walletReferenceID = $decArray[5];
$userId            = $user->data()->id;

$curDate           = date("Y-m-d");
$curTime           = date("h:i:sa");

//data from the session
$paymentType = $_SESSION['type'];
$de_transactionID = $transaction->decodeEasyID($transactionID);
$payeeID = $_SESSION['payeeID'];

if(Token::check(Input::get('token'))){
        $transaction->create(array(
            'transactionID' => $de_transactionID,
            'payeeID' => $payeeID,
            'payerID' => $userId,
            'date' => $curDate,
            'time' => $curTime,
            'statusCode' => $statusCode,
            'walletRefID' => $walletReferenceID,
            'statusDescription' => $statusDescription,
            'amount' => $transactionAmount
        ));

        switch($statusCode){
            case 2: //Completed transaction
                //Type success code here
                $str = "transaction success";
                if($paymentType === 1){
                    //payment type = UCSC registration fee
                    $transaction->updateStatus('UCSC_Registration',array(
                        //paymentstatuss
                        'paymentStatus' => 1
                    ),$de_transactionID);
                }
                elseif($paymentType === 2){
                    //payment type = New academic year fee
                    $transaction->updateStatus('New_Academic_Year',array(
                        //paymentstatuss
                        'paymentStatus' => 1
                    ), $de_transactionID);
                }
                elseif($paymentType === 3){
                    //payment type = Repeat exam fee
                    $transaction->updateStatus('Repeat_Exam',array(
                        //paymentstatuss
                       'paymentStatus' => 1
                    ), $de_transactionID);
                }
                Redirect::to('index.php');
                break;
            case 3: //Failed
                $str = "Transaction failed";
                break;
            case 4: //System error
                $str = "System error";
                break;
            case 5: //Invalid customer
                $str = "tho horek";
                break;
            case 6: //invalid customer status
                $str = "Customer status invalid";
                break;
            case 7: //customer account lock
                $str = "Your ezcash account is locked";
                break;
            case 8: //Invalid transaction type
                $str = "Transaction type invalid";
                break;
            case 9: //Unothorized transaction type
                $str = "Transaction type unothorized";
                break;
            case 10: //Invalid agent
                $str = "Agent invalid";
                break;
            case 11: //Invalid agent status
                $str = "Agent status invalid";
                break;
            case 12: //Entered amount is not in between max or min limits
                $str = "Entered amount is not in between max or min limits";
                break;
            case 13: //eMoney transaction failure
                $str = "eMoney transaction failed";
                break;
            case 14: //Transaction committing failure
                $str = "Failed transaction committing";
                break;
            case 15: //Customer account blocked due to invalid PIN retries
                $str = "Your account is blocked due to invalid PIN retries";
                break;
            case 16: //Active session expired
                $str = "Active session expired";
                break;
        //    default:
        //        echo "Transaction failed";
        }
        Session::flash('home', $str);
        Redirect::to('index.php');
}
?>

<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="POST">

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>