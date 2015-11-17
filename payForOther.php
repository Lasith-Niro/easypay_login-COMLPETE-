<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 9/19/2015
 * Time: 8:07 PM
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
                'username' => array(
                    'required' => true
                )
            )
        );
        if($validation->passed()){
            //Redirect::to('payForOtherSuccess.php');

            ////Checking if username exists or not////
            $userId = $user->data()->id;
            $username = Input::get('username');
            if(!$username== null){
                $user = new User();
                if($user->find($username)){
//                    echo 'User exists<br>';
//                    echo $user->data()->username;
                    //getting other person's userId
                    $opUserId = $user->data()->id;
                    //echo '<br>'.$opUserId;
                    $_SESSION['payeeID'] = $opUserId;
                    //get other person's name
                    $name2 = $user->data()->regNumber;
                    $_SESSION['name2'] = $name2;


                    Redirect::to('payforme.php');

//                    $tempdb = DB::getInstance();
//                    if($tempdb->insert('transaction',array('payerID'=>$userId,'payeeID'=>$opUserId))){
//                        echo 'userId insertion to transaction table completed.' ;
//                    }else{
//                        echo 'userId insertion to transaction table failed.' ;
//                    }



                }else{
                    //echo 'Not exists<br>';
                    echo'<script type="text/javascript">
                        alert("Username does not exists");
                    </script>';
                    //Redirect::to('payForOther.php');
                }
            }
            //echo 'checking completed<br>';



        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '</ br>';
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment | Page</title>
    <?php include 'headerScript.php'?>
</head>
<body>
<div>
    <?php
    include "header.php";
    ?>
</div>

<div class="backgroundImg container-fluid">
    <br>
    <div class="jumbotron col-lg-6 col-lg-offset-3">
        <h3>Please enter the other person's username</h3>
        <form action="" method="post" class="form-horizontal">
            <div>
                <input class="form-control" type="text" name="username" placeholder="Username" <?php echo Input::get('username')?>>
            </div>
            <div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
                <input class="btn btn-default" type="submit" value="Submit">
            </div>
        </form>
    </div>

</div>
<?php
include "footer.php";
?>

</body>
</html>