<?php
require_once 'core/init.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Notification | Page</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <link href="css/stdCSS.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
    </head>
<body>
    <div id="wrapper">
        <?php
        include "header.php";
        ?>
    </div>

<?php
include "adminSidebar.php";
?>
<div class="col-md-9 col-sm-12 col-xs-12">
    <div class="jumbotron col-lg-6 col-lg-offset-1">
    <h3>Add topic</h3>

<?php
$user = new User();
$notification = new Notification();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
    if(Input::exists()){
        if(Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                   'topic' => array(
                       'required' => true,
                       'max' => 255
                   ),
                   'detail' => array(
                       'required' => true
                   )
                )
            );
            if($validation->passed()){
                $topic = Input::get('topic');
                $detail = Input::get('detail');
                $datetime=date("d/m/y h:i:s"); //create date time
                $notification->createNotification(array(
                    'topic' => $topic,
                    'detail' => $detail,
                    'datetime' => $datetime
                    ));

                if($notification){
    //                echo "Successful";
                    Redirect::to('notif_dboard.php');
                }
                else {
                    echo "ERROR";
                }
    //            echo $topic . '</ br>';
    //            echo $detail . '</ br>';
            } else {
                foreach($validation->errors() as $error){
                    echo $error , '</ br>';
                }
            }
        }

    }
?>

<form action="" method="post" class="form-horizontal">
    <div>
        <strong>Topic</strong>
        <input class="form-control" id="topic" type="text" name="topic" value="<?php echo escape(Input::get('topic')); ?>" >
    </div>
    <div>
        <strong>Detail</strong>
        <textarea class="form-control" name="detail" cols="50" rows="3" id="detail" data-slider-value="<?php echo escape(Input::get('detail')); ?>"></textarea>
    </div>
    <input class="btn btn-default" type="submit" name="Submit" value="Submit" />
    <input class="btn btn-default" type="reset" name="Submit2" value="Reset" />
    <input type = "hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
<?php
} else {
    Redirect::to('index.php');
}

include "footer.php";
?>

</body>
</html>