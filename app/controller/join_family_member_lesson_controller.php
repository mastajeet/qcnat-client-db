<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 10:03 PM
 */
class JoinFamilyMemberLessonController extends BaseController
{

    function post($request_data){
        $join = new JoinFamilyMemberLesson(prepare_post_request_data($request_data));
        $join->save();
        $family_member_controller = new FamilyMemberController();
        $family_member_controller->edit_one($request_data['FORM_family_member_id']);

    }

    function obtain_cahier($filter){
        $pool = $filter['filter']['pool'];
        $session = $filter['filter']['session'];
        $level = $filter['filter']['level'];
        $lessons = $this->generate_cahier($session,$pool,$level);
        include_once("app/view/join_family_member_lesson/display_cahier.php");
    }

    function obtain_carton($filter){
        $pool = $filter['filter']['pool'];
        $session = $filter['filter']['session'];
        $level = $filter['filter']['level'];
        $lessons = $this->generate_cahier($session,$pool,$level);
        include_once("app/view/join_family_member_lesson/display_carton.php");

    }


    static function generate_cahier($session,$pool,$level){
        $unordered_lessons = Lesson::get_all_lessons($session,$pool,$level);
        $lessons = [];
        foreach($unordered_lessons as $lesson){
            $lesson->get_all_family_members();
            if(!is_array($lessons[$lesson->day])){
                $lessons[$lesson->day] = [];
            }

            if(!is_array($lessons[$lesson->day][$lesson->time])){
                $lessons[$lesson->day][$lesson->time] = [];
            }

            if(!is_array($lessons[$lesson->day][$lesson->time][$lesson->level])){
                $lessons[$lesson->day][$lesson->time][$lesson->level] = $lesson;
                foreach($lessons[$lesson->day][$lesson->time][$lesson->level]->family_members as $family_member){
                    $join = JoinFamilyMemberLesson::find_by(['lesson_id','family_member_id'],[$lesson->lesson_id,$family_member->family_member_id]);
                    $family_member->lesson_info = array('prefix'=>$join[0]->prefix);
                    $family_member->get_family();
                }
            }
        }

        return $lessons;
    }

    function get_list($filter, $order_by, $order,$nb_per_page, $page){
        $cahier = Lesson::get_all_sessions();
        $cahier = $this->fill_cahier($cahier,$filter);
        include_once("app/view/join_family_member_lesson/list_cahier.php");
    }


    function fill_cahier($cahier, $filter){
        if($filter!=1){
            if(array_key_exists('session',$filter)){
                $cahier[$filter['session']] = Lesson::get_all_pools($filter['session']);
            }
            if(array_key_exists('pool',$filter)){
                $cahier[$filter['session']][$filter['pool']] = Lesson::get_all_days($filter['session'],$filter['pool']);
            }
        }
        return $cahier;
    }

    function edit_one($lesson_id){
        $lesson = new Lesson($lesson_id);
        $lesson->get_all_family_members();
        $lesson->get_all_inscriptions();

        foreach($lesson->inscriptions as $inscription){
            $inscription->family_member->get_family();
            $inscription->family_member->get_previous_lessons();

        }
        include_once("app/view/join_family_member_lesson/add_modifie_lesson_family_members.php");
    }

    function delete_one($ToConfirm,$join_id){
        $join_family_member_lesson = new JoinFamilyMemberLesson($join_id);
        $lesson_id = $join_family_member_lesson->lesson_id;

        if(!$ToConfirm){
            $join_family_member_lesson->destroy();
        }

        $this->edit_one($lesson_id);

    }

}