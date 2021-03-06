<?php
/**
 * Created by PhpStorm.
 * User: mastajeet
 * Date: 17-03-05
 * Time: 20:20
 */

$output = new HTMLHelper();
$output->opentable(600);

$old_pool = "";
$old_session = "";
foreach($lessons as $day=>$times) {
    $time_key = key($times);
    $level_key = key($times[$time_key]);


    if ($old_pool != $times[$time_key][$level_key]->pool or $old_session != $times[$time_key][$level_key]->session){
        $old_pool = $times[$time_key][$level_key]->pool;
        $old_session = $times[$time_key][$level_key]->session;

        $output->openrow();
        $output->opencol('600', 6);

        $output->addtexte($old_session . " - " . $old_pool);
        $output->closecol();
        $output->closerow();
    }

    $output->openrow();
    $output->opencol(25,1);
        $output->addtexte(" ");
    $output->closecol();

    $output->opencol(575,7);
    $output->addtexte($day);
    $output->closecol();

    $output->closerow();

    foreach($times as $time=>$lessons){

        $output->openrow();
        $output->opencol(25,1);
        $output->addtexte(" ");
        $output->closecol();

        $output->opencol(25,1);
        $output->addtexte(" ");
        $output->closecol();

        $output->opencol(550,6);
        $output->addtexte($time);
        $output->closecol();
        $output->closerow();

        foreach($lessons as $lesson){


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

            $output->opencol(425,5);
            $output->addoutput("<a name=".$lesson->lesson_id."></a>");
            $output->addlink('?ressource=join_family_member_lesson&edit=true&ID='.$lesson->lesson_id,$lesson->level);
            $output->closecol();


            $family_member_index = 1;
            $lesson->get_all_inscriptions();
            foreach($lesson->inscriptions as $inscription){
                $inscription->family_member->get_family();


                $inscription->get_payment_status()==PaymentStatus::NOT_RECIEVED ? $payment_status_style = "warning":"";
                $inscription->get_payment_status()==PaymentStatus::RECIVED ? $payment_status_style = "no_warning":"";
                $inscription->get_payment_status()==PaymentStatus::VALIDATED ? $payment_status_style = "clear":"";


                    $output->openrow();
                $output->opencol(25,1);
                $output->addtexte(" ");
                $output->closecol();

                $output->opencol(25,1);
                $output->addtexte(" ");
                $output->closecol();

                $output->opencol(25,1);
                $output->addlink(get_route('obtain_inscription_payment',$inscription->join_family_member_lesson_id),'$',"",$payment_status_style);
                $output->closecol();

                $output->opencol(25,1);

                $prefix = " ";
                if ($inscription->prefix!=""){
                    $prefix = "(".$inscription->prefix.")";
                }
                $output->addtexte($prefix);
                $output->closecol();

                $output->opencol(25,1);
                $output->addtexte($family_member_index);
                $output->closecol();

                $output->opencol(200,1);
                $output->addlink(get_route('edit_family_member',$inscription->family_member->family_member_id) , $inscription->family_member->name." ".$inscription->family_member->lastname,"_BLANK");
                $output->closecol();

                $output->opencol(25,1);
                $output->addtexte($inscription->family_member->age());
                $output->closecol();

                $output->opencol(175,1);
                $output->addphone($inscription->family_member->family->tel_1,1);
                $output->closecol();

                $output->closerow();

                $family_member_index++;
            }
        }
    }
}
echo $output->send(1);