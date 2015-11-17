<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 10/17/2015
 * Time: 3:20 PM
 */

require_once 'core/init.php';

if(isset($_POST['searchVal'])){
    $searchUser = $_POST['searchVal'];
    $userDet = DB::getInstance();
    if($searchUser!=null){
        $userDet->get('users',array('username','LIKE',"%$searchUser%"));
    }
    if(!$userDet->count()){
        $output = 'No match found<br>';
        echo $output;
    }else{
        foreach($userDet->results() as $res){
            $output = $res->username;
//            echo "$output<br>";
            echo "<li><a href='admin_searchUserResults.php?searchUser=$output'>$output</a></li>";
        }
    }

}



