<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-05
 * Time: 9:48 PM
 */

$output->addpic('ressource/icon/add_ressource.png',null,get_route('add_family_member').'&family_id='.$family->family_id);

$output->opentable(1150);

$output->openrow();

$output->opencol();
$output->addtexte(" ",'Titre');
$output->closecol();

$output->opencol();
$output->addtexte(ucfirst(FIRSTNAME),'Titre');
$output->closecol();

$output->opencol();
$output->addtexte(ucfirst(ROLE),'Titre');
$output->closecol();

$output->opencol();
$output->addtexte(ucfirst(SEX),'Titre');
$output->closecol();


$output->opencol();
$output->addtexte(ucfirst(DATE_OF_BIRTH),'Titre');
$output->closecol();

$output->opencol();
$output->addtexte(ucfirst(LASTCOURSE),'Titre');
$output->closecol();

$output->closerow();

foreach($family->family_members as $member){


    $output->openrow();


    $output->opencol(25);
    $output->addpic('ressource/icon/edit_ressource.png',NULL,get_route("edit_family_member",$member->family_member_id));
    $output->closecol();


    $output->opencol(100);
    $output->addtexte($member->name);
    $output->closecol();

    $output->opencol(100);
    $output->addtexte(Role::get_value($member->role));
    $output->closecol();

    $output->opencol(100);
    $output->addtexte(SEX::get_value($member->sex));
    $output->closecol();

    $output->opencol(100);
    if($member->date_of_birth=="1970-01-01 00:00:00")
        $output->addtexte(" ");
    else
        $output->addtexte($member->date_of_birth);
    $output->closecol();

    $output->opencol(600);
    $member->get_last_lesson();
    $output->addtexte($member->last_lesson);
    $output->closecol();



    $output->closerow();
    $output->closerow();

}
$output->closetable();
