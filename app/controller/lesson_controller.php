<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 10:03 PM
 */
class LessonController extends base_controler
{

    function sync_qndb(){
        $qndb_all_sessions = json_decode(file_get_contents(QNDB_API_LESSON_PATH),true);

        $added_lesson = array();
        $updated_lesson = array();
        foreach($qndb_all_sessions as $lesson_id => $lesson_items){
            $a = Lesson::is_lesson_in_db($lesson_items['session'],$lesson_items['pool'],$lesson_items['day'],$lesson_items['time'],$lesson_items['level']);
            if(!$a){
                $lesson = new Lesson($lesson_items);
                $lesson->save();
                $added_lesson[] = $lesson_items['session']." ".$lesson_items['pool']." ".$lesson_items['day']." ".$lesson_items['time']." ".$lesson_items['level'];
            }else{
                $lesson = new Lesson($a);
                $updated_lesson[] = $lesson_items['session']." ".$lesson_items['pool']." ".$lesson_items['day']." ".$lesson_items['time']." ".$lesson_items['level'];
            }

        }
        include_once("app/view/lesson/sync_report.php");
    }

    function get_list($filter, $order_by, $order,$nb_per_page, $page){
        $lessons = Lesson::get_all($filter, $order_by, $order,$nb_per_page, $page);
        include("app/view/lesson/display_lessons.php");
    }

    function create_one($args)
    {
        $lesson = new Lesson();
        include("app/view/lesson/add_modifie_lesson.php");
    }

    function edit_one($ID){
        $lesson = new Lesson($ID);
        include_once("app/view/lesson/add_modifie_lesson.php");
    }

    function post($request_data){
        $lesson = new Lesson(prepare_post_request_data($request_data));
        $ID = $lesson->save();
        $join_family_member_lesson_controller = new JoinFamilyMemberLessonController();
        $filter =
            [
                'filter'=>[
                        'pool'=>$lesson->pool,
                        'session'=>$lesson->session
                ]

            ];

        $join_family_member_lesson_controller->obtain_carton($filter);
    }

    function search($request_data){
        include_once('app/controller/join_family_member_lesson_controller.php');
        $filters = $request_data['filter'];
        $search_criteria = new Lesson($filters);


        include("app/view/lesson/search_form.php");


        if(isset($filters) and count(array_count_values($filters))>2){
            $lessons = JoinFamilyMemberLessonController::generate_cahier($filters['session'],$filters['pool'],$filters['level']);
            include("app/view/join_family_member_lesson/display_cahier.php");
        }
    }

}