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

require_once('test_data.php');

class TestFamilyModel extends PHPUnit_Framework_TestCase
{

    function test_creating_new_family(){

        $family = TestData::generate_family();
        $my_family = new Family($family);
        $this->assertEquals($my_family->name,'family_name');
        $this->assertEquals($my_family->tel_1,'4189999999');
        $this->assertEquals($my_family->email,'okay@gmail.com');
        $this->assertEquals($my_family->address,'2020 du finfin');
    }

    function test_adding_new_family_in_db(){

        $family = TestData::generate_family();
        $my_family = new Family($family);
        $my_family->save();

        $my_retrieved_family = Family::last();
        $this->assertEquals($my_retrieved_family->name,'family_name');
        $this->assertEquals($my_retrieved_family->tel_1,'4189999999');
        $this->assertEquals($my_retrieved_family->email,'okay@gmail.com');
        $this->assertEquals($my_retrieved_family->address,'2020 du finfin');

    }

    function test_modify_family_in_db(){

        $family = TestData::generate_family();
        $my_family = new Family($family);
        $my_family->save();

        $my_retrieved_family = Family::last();
        $this->assertEquals('family_name',$my_retrieved_family->name);

        $my_retrieved_family->name = 'new_family_name';
        $my_retrieved_family->save();

        $my_retrieved_family = Family::last();
        $this->assertEquals('new_family_name',$my_retrieved_family->name);

    }

    function test_adding_family_member(){
        $family_array = TestData::generate_family();
        $family = new Family($family_array);
        $family->save();
        $member_1_array = TestData::generate_parent_family_member($family->family_id);
        $member_2_array = TestData::generate_children_family_member($family->family_id);

        $member_1 = new FamilyMember($member_1_array);
        $member_2 = new FamilyMember($member_2_array);

        $family->family_members = $member_1;
        $family->family_members = $member_2;

        $this->assertEquals(2,count($family->family_members));
    }

    function test_updating_family_member(){
        $family_array = TestData::generate_family();
        $family = new Family($family_array);
        $family->save();
        $member_1_array = TestData::generate_children_family_member($family->family_id);
        $member_1 = new FamilyMember($member_1_array);
        $family->family_members = $member_1;
        $family_member = $family->family_members[0];
        $family_member ->name = "milenie";
        $family->save();
        $last_member = FamilyMember::last();
        $this->assertEquals("milenie",$last_member->name);
    }

    function test_populating_family_member_with_family_members(){
        $family_array = TestData::generate_family_2();
        $family = new Family($family_array);
        $family->save();
        $member_1_array = TestData::generate_children_family_member($family->family_id);
        $member_1 = new FamilyMember($member_1_array);
        $family->family_members = $member_1;
        $last_family = new Family($family->save());
        $last_family->get_family_members();
        $this->assertEquals($last_family->family_members[0]->name,'Rory');
    }

}