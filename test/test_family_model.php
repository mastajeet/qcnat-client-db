<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-24
 * Time: 9:42 PM
 */


require_once('../app/model/family.php');
require_once('../app/model/family_member.php');
require_once('../app/helper/MySQLHelper.php');
require_once('../db_credentials.php');
require_once('../constants.php');


class test_family_model extends PHPUnit_Framework_TestCase
{

    static function generate_family(){
        $family = array(
            'name'=>'family_name',
            'tel_1'=>'4189999999',
            'email'=>'okay@gmail.com',
            'address'=>'2020 du finfin'
        ) ;

        return $family;
    }

    static function generate_parent_family_member($family_id){
        $family_member = array(
            'family_id'=>$family_id,
            'name'=>'Michel',
            'date_of_birth'=>'1955-08-31 23:05:00',
            'sex'=>sex::MEN,
            'role'=>role::PARENT);
        return $family_member;
    }

    static function generate_children_family_member($family_id){
        $family_member = array(
            'family_id'=>$family_id,
            'name'=>'Rory',
            'date_of_birth'=>'2000-08-31 23:05:00',
            'sex'=>sex::WOMEN,
            'role'=>role::CHILD);
        return $family_member;
    }

    function test_creating_new_family(){

        $family = test_family_model::generate_family();
        $my_family = new family($family);
        $this->assertEquals($my_family->name,'family_name');
        $this->assertEquals($my_family->tel_1,'4189999999');
        $this->assertEquals($my_family->email,'okay@gmail.com');
        $this->assertEquals($my_family->address,'2020 du finfin');
    }

    function test_adding_new_family_in_db(){

        $family = test_family_model::generate_family();
        $my_family = new family($family);
        $my_family->save();

        $my_retrieved_family = family::last();
        $this->assertEquals($my_retrieved_family->name,'family_name');
        $this->assertEquals($my_retrieved_family->tel_1,'4189999999');
        $this->assertEquals($my_retrieved_family->email,'okay@gmail.com');
        $this->assertEquals($my_retrieved_family->address,'2020 du finfin');

    }

    function test_modify_family_in_db(){

        $family = test_family_model::generate_family();
        $my_family = new family($family);
        $my_family->save();

        $my_retrieved_family = family::last();
        $this->assertEquals('family_name',$my_retrieved_family->name);

        $my_retrieved_family->name = 'new_family_name';
        $my_retrieved_family->save();

        $my_retrieved_family = family::last();
        $this->assertEquals('new_family_name',$my_retrieved_family->name);

    }

    function test_adding_family_member(){
        $family_array = test_family_model::generate_family();
        $family = new family($family_array);
        $family->save();
        $member_1_array = test_family_model::generate_parent_family_member($family->family_id);
        $member_2_array = test_family_model::generate_children_family_member($family->family_id);

        $member_1 = new family_member($member_1_array);
        $member_2 = new family_member($member_2_array);

        $family->family_members = $member_1;
        $family->family_members = $member_2;

        $this->assertEquals(2,count($family->family_members));
    }

    function test_updating_family_member(){
        $family_array = test_family_model::generate_family();
        $family = new family($family_array);
        $family->save();
        $member_1_array = test_family_model::generate_children_family_member($family->family_id);
        $member_1 = new family_member($member_1_array);
        $family->family_members = $member_1;
        $family_member = $family->family_members[0];
        $family_member ->name = "milenie";
        $family->save();
        $last_member = family_member::last();
        $this->assertEquals("milenie",$last_member->name);
    }

    function test_populating_family_member_with_family_members(){
        $family_array = test_family_model::generate_family();
        $family = new family($family_array);
        $family->save();
        $member_1_array = test_family_model::generate_children_family_member($family->family_id);
        $member_1 = new family_member($member_1_array);
        $family->family_members = $member_1;
        $family->save();
        $last_family = family::last();
        $last_family->get_family_members();
        $this->assertEquals($last_family->family_members[0]->name,'Rory');
    }

}