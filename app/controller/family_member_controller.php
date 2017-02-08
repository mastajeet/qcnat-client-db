<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 10:03 PM
 */
class FamilyMemberController extends base_controler
{

    function create_one($args)
    {
        $family = new Family($args['family_id']);
        $family_member = new FamilyMember(array('family_id'=>$args['family_id'],'lastname'=>$family->name));
        include("app/view/family_member/add_modify_family_member.php");
    }

    function edit_one($ID){
        $family_member  = new FamilyMember($ID);
        $family = new Family($family_member->family_id);
        include("app/view/family_member/add_modify_family_member.php");
    }

    function post($request_data){
        $family_member = new FamilyMember(prepare_post_request_data($request_data));
        $family_member ->save();

        $family_controller = new FamilyController();
        $family_controller->get_one($family_member->family_id);

    }
}