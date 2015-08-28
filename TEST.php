<?php
require_once 'core/init.php';
$statusCode = 2;
$transactionID     = 'trans001';
$statusDescription = 'test transaction';
$transactionAmount = '10.00';
$merchantCode      = 'TESTMERCHANT';
$walletReferenceID = '1221515548';
$userId = 1;
$curDate = date("Y-m-d");
$curTime = date("h:i:sa");

$tra = new Transaction();

$tra->create(array(
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
//        Session::flash('home', "Your payment succesfully added!");
        $str = "Your payment succesfully added!";
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

?>
