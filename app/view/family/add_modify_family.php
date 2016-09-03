<?php

$output = new HTMLHelper();

$output->addform(ADD_MODIFY_FAMILY);

$output->inputhidden_env('ressource','family');
$output->inputhidden('family_id',$family->family_id);

$output->inputtext('name',0,NAME,$value=$family->name);
$output->inputtext('email',0,EMAIL,$value=$family->email);
$output->inputtext('address',0,ADDRESS,$value=$family->address);
$output->inputphone('tel_1',TELEPHONE." - 1",$value=$family->tel_1);
$output->inputphone('tel_2',TELEPHONE." - 2",$value=$family->tel_2);

$output->formsubmit(ADD_MODIFY);

echo $output->send(1);