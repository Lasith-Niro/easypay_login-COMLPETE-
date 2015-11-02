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
    <meta charset="UTF-8">
    <title>Payment | Page</title>
    <link href="css/customCss.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<div>
    <?php
    include "header.php";
    ?>
</div>

<div class="container backgroundImg">
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