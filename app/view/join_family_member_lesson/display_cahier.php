<?php
/**
 * Created by PhpStorm.
 * User: mastajeet
 * Date: 17-03-05
 * Time: 20:20
 */

$output = new HTMLHelper();
$output->opentable(600);

$output->openrow();
$output->opencol('600',6);

    $output->addtexte($session." - ".$pool);
$output->closecol();
$output->closerow();

foreach($lessons as $day=>$times){
    $output->openrow();
    $output->opencol(25,1);
        $output->addtexte(" ");
    $output->closecol();

    $output->opencol(575,6);
    $output->addtexte($day);
    $output->closecol();

    $output->closerow();

    foreach($times as $time=>$levels){

        $output->openrow();
        $output->opencol(25,1);
        $output->addtexte(" ");
        $output->closecol();

        $output->opencol(25,1);
        $output->addtexte(" ");
        $output->closecol();

        $output->opencol(550,5);
        $output->addtexte($time);
        $output->closecol();
        $output->closerow();

        foreach($levels as $level=>$family_members){



            $output->openrow();
            $output->opencol(25,1);
            $output->addtexte(" ");
            $output->closecol();

            $output->opencol(25,1);
            $output->addtexte(" ");
            $output->closecol();

            $output->opencol(25,1);
            $output->addtexte(" ");
            $output->closecol();

            $output->opencol(425,4);
            $output->addtexte($level);
            $output->closecol();



            foreach($family_members as $family_member){

                $output->openrow();
                $output->opencol(25,1);
                $output->addtexte(" ");
                $output->closecol();

                $output->opencol(25,1);
                $output->addtexte(" ");
                $output->closecol();

                $output->opencol(25,1);
                $output->addtexte(" ");
                $output->closecol();

                $output->opencol(25,1);

                $prefix = " ";
                if ($family_member->lesson_info['prefix']!=""){
                    $prefix = "(".$family_member->lesson_info['prefix'].")";
                }
                $output->addtexte($prefix);
                $output->closecol();

                $output->opencol(200,1);
                $output->addtexte($family_member->name." ".$family_member->lastname);
                $output->closecol();

                $output->opencol(25,1);
                $output->addtexte($family_member->age());
                $output->closecol();

                $output->opencol(175,1);
                $output->addtexte($family_member->family->tel_1);
                $output->closecol();

                $output->closerow();
            }
        }
    }
}
echo $output->send(1);