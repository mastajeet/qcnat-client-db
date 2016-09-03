<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:36 PM
 */
include_once("base_controler.php");
class family_controller extends base_controler{

    function get_list($filters){
        $families = Family::get_all();
        include("app/view/family/display_families.php");
    }

    function create_one()
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
}