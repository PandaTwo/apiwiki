<?php
/**
 * Created by PhpStorm.
 * User: UserPC
 * Date: 2015/4/26
 * Time: 22:51
 */

function alert($msg,$url = '')
{
    $location ='';
    if($url){
        $location = "location.href='".$url."';";
    }
    echo "<script>alert('$msg');$location</script>";
}