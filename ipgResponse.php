<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro with surangi-edirisinghe
 * Date: 26/08/15
 * Time: 09:10
 */
require_once 'core/init.php';
require 'payment/decrypt.php';

$user = new User();
$dec = new decrypt();
$transaction = new Transaction();

$encrypted = $_POST['merchantReciept'];
//For testing
//$encrypted = 'safsf5dg5dfg5dd45665hdfh6vdfdfd53dd5df53bdfb3dfb1df53b1dfb531f53b1fb56fgerger564s53bg4n3f534v3sdv3db14d53c1b53df1b53df3'
$decryptObject = $dec->decode($encrypted);
$decArray = explode('|',$decryptObject);

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//Declare and assign values to variables
$transactionID     = $decArray[0];
$statusCode        = $decArray[1];
$statusDescription = $decArray[2];
$transactionAmount = $decArray[3];
$merchantCode      = $decArray[4];
$walletReferenceID = $decArray[5];
$userId            = $user->data()->id;
$curDate           = date("Y-m-d");
$curTime           = date("h:i:sa");

/* TEST DATA
$transactionID     = '001';
$statusCode        = 2;
$statusDescription = "test payment";
$transactionAmount = 10.00;
$merchantCode      = "TESTMERCHANT";
$walletReferenceID = '5001';
*/

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $transaction->create(array(
            'payeeID' => $userId,
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
}

?>

<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="POST">

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>