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
$output->addphone($family->tel_1,true);
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

include('app/view/family_member/display_family_member_from_one_family.php');

echo $output->send(1);





