<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:51 PM
 */

$output = new HTMLHelper();

$output->addpic('ressource/icon/add_ressource.png',null,get_route('add_family'));

$output->opentable($width=750);
$output->openrow();

$output->opencol($width=20);
$output->addtexte(" ",$class='Titre');
$output->closecol();

$output->opencol($width=40);
$output->addtexte("ID",$class='Titre');
$output->closecol();

$output->opencol($width=210);
$output->addtexte(ucfirst(NAME),$class='Titre');
$output->closecol();

$output->opencol($width=150);
$output->addtexte(ucfirst(EMAIL),$class='Titre');
$output->closecol();

$output->opencol($width=150);
$output->addtexte(ucfirst(TELEPHONE)." - 1",$class='Titre');
$output->closecol();

$output->opencol($width=150);
$output->addtexte(ucfirst(TELEPHONE)." - 2",$class='Titre');
$output->closecol();
$output->closerow();

foreach($families as $family){

    $output->openrow();
    $output->opencol($width=20);
        $output->addpic('ressource/icon/edit_ressource.png','',$link=get_route('edit_family',$family->family_id));
    $output->closecol();

    $output->opencol();
        $output->addtexte($family->family_id+INITIAL_ID);
    $output->closecol();


    $output->opencol();
        $output->addlink(get_route('display_family',$family->family_id),$family->name);
    $output->closecol();

    $output->opencol();
        $output->addtexte($family->email);
    $output->closecol();

    $output->opencol();
    $output->addphone($family->tel_1);
    $output->closecol();

    $output->opencol();
    $output->addphone($family->tel_2);
    $output->closecol();
    $output->closerow();

}

echo $output->send(1);

