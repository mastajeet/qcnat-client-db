<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-13
 * Time: 10:23 PM
 */
$output = new HTMLHelper();
$output->addtexte(SESSION_ADDED,'titre');
$output->br(2);
foreach($added_lesson as $v){
    $output->addtexte($v);
    $output->br();
}
$output->br();
$output->addtexte(SESSION_UPDATED,'titre');
$output->br(2);
foreach($updated_lesson as $v){
    $output->addtexte($v);
    $output->br();
}

print($output->send(1));