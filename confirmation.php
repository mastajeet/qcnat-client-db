<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 16/05/17
 * Time: 1:44 PM
 */

$ToConfirm = FALSE;
if(isset($_GET['ToConfirm'])){
    $ToConfirm = TRUE;
    $method = "GET";
    $request_String = $_SERVER['QUERY_STRING'];

}elseif(isset($_GET['ToConfirm'])){
    $ToConfirm = TRUE;
    $method = "POST";
    $request_String = $_SERVER['QUERY_STRING'];

}

if($ToConfirm){
    $new_uri = str_replace("&ToConfirm=True",'',$request_String);
    $output = new HTMLHelper();
    $output->addlink("?".$new_uri,CONFIRM,"",'warning');
    echo $output->send(1);
}