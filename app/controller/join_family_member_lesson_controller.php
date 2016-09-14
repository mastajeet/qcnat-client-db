<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 10:03 PM
 */
class JoinFamilyMemberLessonController extends base_controler
{

    function post($request_data){
        $join = new JoinFamilyMemberLesson(prepare_post_request_data($request_data));
        $join->save();
        $family_member_controller = new FamilyMemberController();
        $family_member_controller->edit_one($request_data['FORM_family_member_id']);

    }

}