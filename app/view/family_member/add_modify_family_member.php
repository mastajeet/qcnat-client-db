<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-05
 * Time: 9:47 PM
 */
$output = new HTMLHelper();
$output->opentable(800);
$output->openrow();
$output->opencol(800);
$output->addform(ADD_MODIFY_FAMILY_MEMBER);
$output->inputhidden('family_id',$family_member->family_id);
$output->inputhidden('family_member_id',$family_member->family_member_id);
$output->inputhidden_env('ressource','family_member');
$output->openrow();
    $output->opencol();
        $output->addtexte(ucfirst(FAMILY),'titre');
    $output->closecol();

    $output->opencol();
        $output->addtexte($family->name);
    $output->closecol();
$output->closerow();

$output->inputtext('name',FIRSTNAME,28,$family_member->name);
$output->inputtext('name',LASTNAME,28,$family_member->lastname);
$output->inputradio('sex',Sex::get_constants(),$family_member->sex,SEX,'VER');
$output->inputradio('role',Role::get_constants(),$family_member->role,ROLE,'VER');
$output->inputtime('date_of_birth',DATE_OF_BIRTH,$family_member->date_of_birth,array('Date'=>true,'Time'=>false));
$output->formsubmit(ADD_MODIFY);


$output->closecol();
$output->closerow();
$output->closetable();


$output->opentable(800);
$output->openrow();
$output->opencol(800);
$output->addform(ADD_JOIN_FAMILY_MEMBER_LESSON);
$output->inputhidden('family_member_id',$family_member->family_member_id);
$output->inputhidden_env('ressource','join_family_member_lesson');

$output->inputselect('lesson_id',Lesson::get_all_in_list("session='A16'"),NULL,JOIN_FAMILY_MEMBER_LESSON);
$output->formsubmit(ADD_MODIFY);


$output->closecol();
$output->closerow();
$output->closetable();











echo $output->send(1);
