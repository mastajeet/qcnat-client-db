<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:51 PM
 */


$output = new HTMLHelper();
$output->opentable(600);
$output->openrow();
$output->opencol();
$output->addtexte(ucfirst(NAME),'Titre');
$output->closecol();

$output->opencol();
$output->addtexte($family->name);
$output->closecol();
$output->closerow();


$output->openrow();
$output->opencol();
$output->addtexte(ucfirst(EMAIL),'Titre');
$output->closecol();

$output->opencol();
$output->addtexte($family->email);
$output->closecol();
$output->closerow();


$output->openrow();
$output->opencol();
$output->addtexte(ucfirst(TELEPHONE),'Titre');
$output->closecol();

$output->opencol();
$output->addphone($family->tel_1);
$output->closecol();
$output->closerow();

$output->openrow();
$output->opencol();
$output->addtexte(ucfirst(ADDRESS),'Titre');
$output->closecol();

$output->opencol();
$output->addtexte($family->address);
$output->closecol();
$output->closerow();


$output->openrow();
$output->opencol(400,2);
    $output->addtexte("------------------------------------------------------------");
$output->closecol();
$output->closerow();
$output->closetable();

$output->addpic('ressource/icon/add_ressource.png',null,get_route('add_family_member'));

$output->opentable(600);

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
    $output->addtexte(ucfirst(DATE_OF_BIRTH),'Titre');
$output->closecol();

$output->opencol();
    $output->addtexte(ucfirst(LASTCOURSE),'Titre');
$output->closecol();

$output->closerow();

foreach($family->family_members as $member){


    $output->openrow();


    $output->opencol(25);
    $output->addpic('ressource/icon/edit_ressource.png',get_route("edit_family_member",$member->family_member_id));
    $output->closecol();


    $output->opencol(100);
        $output->addtexte($member->name);
    $output->closecol();

    $output->opencol(100);
    $output->addtexte($member->role);
    $output->closecol();

    $output->opencol(100);
    $output->addtexte($member->date_of_birth);
    $output->closecol();

    $output->opencol(100);
    $output->addtexte($member->last_course);
    $output->closecol();



    $output->closerow();
}


echo $output->send(1);





