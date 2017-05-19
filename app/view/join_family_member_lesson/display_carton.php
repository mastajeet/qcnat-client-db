<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 12/05/17
 * Time: 10:31 AM
 */


$output = new HTMLHelper();
$output->opentable('100%');

$output->openrow();
$output->opencol('100%',1);
    $output->addtexte($session." - ".$pool);
$output->closecol();
$output->closerow();

$output->openrow();
$output->opencol('100%',1);

foreach($lessons as $day=>$times){
    $output->br(2);
    $output->addtexte($day);



    foreach($times as $time=>$lessons){
        $output->br(2);
        $output->opentable("100%",2,2,1);
        $output->openrow();
        $output->opencol(50,1,'top','',$other="rowspan=2");
            $output->addtexte($time);
        $output->closecol();

        $level_list = LessonLevel::get_lession_level_list_ordered_for_cartons();
        $pos = 0;

        $nb_demi_corridor_total = 0;
        $nb_demi_corridor_place = 0;
        foreach($lessons as $lesson){
            $nb_demi_corridor_total += (LessonLevel::get_lession_level_corridor_size($lesson->level)==1);
        }
        $nb_demi_corridor_switch = ceil($nb_demi_corridor_total/2);
        $extra_row = FALSE;


        foreach($level_list as $level){

            if(array_key_exists($level,$lessons)){
                $nb_corridor = LessonLevel::get_lession_level_corridor_size($level);



                if($nb_demi_corridor_total>0 and $nb_demi_corridor_place==$nb_demi_corridor_switch and !$extra_row){

                    $extra_row = TRUE;
                    $output->openrow();

                }
                if($nb_corridor==1){
                    $nb_demi_corridor_place++;
                }

                $output->opencol(125,1,'top','',"rowspan=".$nb_corridor);
                $output->addoutput("<a name=".$lessons[$level]->lesson_id."></a>");
                $output->addpic('ressource/icon/add_ressource.png','','index.php?ressource=join_family_member_lesson&edit=true&ID='.$lessons[$level]->lesson_id);
                $output->addpic('ressource/icon/edit_ressource.png','','index.php?ressource=lesson&edit=true&ID='.$lessons[$level]->lesson_id);
                $output->addtexte($level,"Titre");
                $output->br(2);
                $nb_participant = 0;
                foreach($lessons[$level]->family_members as $family_member){
                    $output->addtexte("- ".$family_member->name." ".$family_member->lastname);
                    $output->br();
                    $nb_participant++;
                }



                if($pos==2){
                    $output->closecol();
                }

                if($nb_demi_corridor_total>0 and $nb_demi_corridor_place==$nb_demi_corridor_switch){
                    $output->closerow();
                }



            }

        }


        $output->closerow();
        $output->closetable();
    }



}

$output->closecol();
$output->closerow();


echo $output->send(1);