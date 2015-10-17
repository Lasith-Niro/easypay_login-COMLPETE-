<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 13/09/15
 * Time: 23:28
 */
/*
     ######    ##     ####    #   #  #####     ##     #   #   ####   #
     #        #  #   #         # #   #    #   #  #     # #   #       #
     #####   #    #   ####      #    #    #  #    #     #     ####   #
     #       ######       #     #    #####   ######     #         #  #
     #       #    #  #    #     #    #       #    #     #    #    #  #
     ######  #    #   ####      #    #       #    #     #     ####   ######
*/
//require_once('Files/accessFile.php');
//$fileObject = new accessFile();
//
//$data = "2015-08-20";
//$fileObject->write('Files/date', $data . '\n');
//echo "ok";
//
//$data2 = "2015-08-25";
//$fileObject->write('Files/date', $data2 . '\n');

?>
<?
/*
$strFull = "easyID_1221";
//echo $str . "<br>";
$str = trim($strFull,"easyID_");
echo $str . '<br />';
$count = substr_count($str, '0');
echo $count . '<br />';
$final = substr_replace($str,'',0,$count);
echo $final;
//$final = substr_replace('0','z',$str,$count);
//echo $final;
*/
?>
<?
//require_once 'core/init.php';
//$db = DB::getInstance();
//$result = $db->getAll('SELECT username','users', '')->results();
////$result = mysql_query($sql);
//echo "<select name='usernameCMB'>";
//foreach ($result as $row) {
//    echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
//}
//echo "</select>";
//
?>
<?
//require_once 'core/init.php';
//
//if(isset($_POST['search']))
//{
//
//    $makerValue = $_POST['Make']; // make value
//
//    $maker = mysql_real_escape_string($_POST['selected_text']); // get the selected text
//    echo $maker;
//}

?>
<!---->
<!--<form method="POST" >-->
<!--    <label for="Manufacturer"> Manufacturer : </label>-->
<!--    <select id="cmbMake" name="Make"     onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">-->
<!--        <option value="0">Select Manufacturer</option>-->
<!--        <option value="1">--Any--</option>-->
<!--        <option value="2">Toyota</option>-->
<!--        <option value="3">Nissan</option>-->
<!--    </select>-->
<!--    <input type="hidden" name="selected_text" id="selected_text" value="" />-->
<!--    <input type="submit" name="search" value="Search"/>-->
<!--</form>-->
<?php
/*
$statusCode = 2;
$transactionID     = 'trans001';
$statusDescription = 'test transaction';
$transactionAmount = '10.00';
$merchantCode      = 'TESTMERCHANT';
$walletReferenceID = '1221515548';
$userId = 1;
$curDate = date("Y-m-d");
$curTime = date("h:i:sa");



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
*/
?>
<html>
<style>
    #browserother {
        display:none;
    }
    #osother {
        display:none;
    }
</style>
<p>Chose Your Browser: <select name = "Browser" required>
        <option value = "">-- Select an Option --</option>
        <option value = "1">IE</option>
        <option value = "2">FF</option>
        <option value = "3">Safari</option>
        <option value = "4">Opera</option>
        <option value = "5">Other</option>
    </select>
</p>
<div id="browserother">
    <p>Please Specify: <label id="browserlabel"><input name="Other Browser" type="text" placeholder="Other Browser" size="50" /></label></p>
</div>

<p>Operating System: <select name = "OS" required>
        <option value = "">-- Select an Option --</option>
        <option value = "Win">Windows</option>
        <option value = "ios">iOS</option>
        <option value = "otheros">Other</option>
    </select>
</p>
<div id="osother">
    <p>Please Specify: <label id="oslabel"><input name="Other OS" type="text" placeholder="Other OS" size="50" /></label></p>
</div>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
    $('select[name=Browser]').change(function () {
        if ($(this).val() == '5') {
            $('#browserother').show();
        } else {
            $('#browserother').hide();
        }
    });

    $('select[name=OS]').change(function () {
        if ($(this).val() == 'otheros') {
            $('#osother').show();
        } else {
            $('#osother').hide();
        }
    });

</script>
