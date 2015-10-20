<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/14/2015
 * Time: 8:13 PM
 */

require_once 'core/init.php';

$user = new user();
if(Input::exists()) {
    $searchUser = Input::get('search');
    $tdb = DB::getInstance();
    $tdb->get('users',array('username','=',$searchUser));
    if(!$tdb->count()){
        echo 'no user';
    }else {
//            print_r($tdb->results());
        foreach($tdb->results()as $res){
            echo $user->data()->username;
            if($user->data()->username!=$res->username){
//                   echo $res->username.'<br>';
                echo "<a href='admin_searchUserResults.php?searchUser=$res->username'>$res->username</a>";
                echo "<br>";
            }else{
                echo $res->username.': This is your username<br>';
            }
        }
    }
}


?>
<html lang="en">
<head>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>

<!--    dropdown menu styles-->
    <style>
        #res{
            cursor:pointer;
            height:150px;
            overflow-y:scroll;
        }
    </style>
</head>
<body>
<div>
    <form action="" method="post">
        <div>
            <input type="text" id="search" placeholder="Enter username to search" autocomplete="off" name="search" value="<?php echo Input::get('search')?>" onkeyup="autoSuggest('res','search.php');"  />
            <input type="submit" value="Search">
        </div>
    </form>

    <div id="res">

    </div>
</div>


</body>
</html>