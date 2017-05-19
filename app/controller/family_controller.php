<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:36 PM
 */
include_once("BaseController.php");

class FamilyController extends BaseController{

    function get_list($filter, $order_by, $order,$nb_per_page, $page){
        $families = Family::get_all($filter, $order_by, $order,$nb_per_page, $page);
        include("app/view/family/display_families.php");
    }

    function create_one($args)
    {
        $family = new Family();
        include("app/view/family/add_modify_family.php");
    }

    function get_one($ID){
        $family  = new Family($ID);
        $family->get_family_members();
        include("app/view/family/display_family.php");
    }

    function edit_one($ID){
        $family  = new Family($ID);
        include("app/view/family/add_modify_family.php");
    }

    function post($request_data){
        $family = new Family(prepare_post_request_data($request_data));
        $ID = $family->save();
        $this->get_one($ID);
    }

    function nested_insert($request_data){

        generate_from_add_family_member_to_lesson($request_data);
        //logic for adding new nested family
        $join_family_member_lesson_controller = new JoinFamilyMemberLessonController();
        $join_family_member_lesson_controller->edit_one($request_data['lesson_id']);

    }
}