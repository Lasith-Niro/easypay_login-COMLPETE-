<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro with surangi-edirisinghe
 * Date: 26/08/15
 * Time: 09:10
 */

require_once 'core/init.php';
require 'payment/decrypt.php';

$decryptObjectArray = new decrypt();
//return $decryptObject;
$transactionID     = $decryptObjectArray[0];
$statusCode        = $decryptObjectArray[1];
$statusDescription = $decryptObjectArray[2];
$transactionAmount = $decryptObjectArray[3];
$merchantCode      = $decryptObjectArray[4];
$walletReferenceID = $decryptObjectArray[5];


switch($statusCode){
    case 2: //Completed transaction
        //Type success code here

        break;
    case 3: //Failed
        echo "Transaction failed";
        break;
    case 4: //System error
        echo "System error";
        break;
    case 5: //Invalid customer
        echo "tho horek";
        break;
    case 6: //invalid customer status
        echo "Customer status invalid";
        break;
    case 7: //customer account lock
        echo "Your ezcash account is locked";
        break;
    case 8: //Invalid transaction type
        echo "Transaction type invalid";
        break;
    case 9: //Unothorized transaction type
        echo "Transaction type unothorized";
        break;
    case 10: //Invalid agent
        echo "Agent invalid";
        break;
    case 11: //Invalid agent status
        echo "Agent status invalid";
        break;
    case 12: //Entered amount is not in between max or min limits
        echo "Entered amount is not in between max or min limits";
        break;
    case 13: //eMoney transaction failure
        echo "eMoney transaction failed";
        break;
    case 14: //Transaction committing failure
        echo "Failed transaction committing";
        break;
    case 15: //Customer account blocked due to invalid PIN retries
        echo "Your account is blocked due to invalid PIN retries";
        break;
    case 16: //Active session expired
        echo "Active session expired";
        break;
//    default:
//        echo "Transaction failed";




}

?>

<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="POST">

</form>