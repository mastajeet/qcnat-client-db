<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 12:41 PM
 */

require_once ('../app/model/family.php');
require_once ('../app/model/family_member.php');
require_once ('../app/model/lesson.php');
require_once ('../app/helper/basic_enum.php');
require_once ('../enums.php');

class TestData
{


    static function generate_lesson(){
        $lesson = array(
            'level'=>'Junior 10',
            'session'=>'Hiver 2016',
            'pool'=>'Limoilou',
            'instructor'=>'Richard Bernier',
            'time'=>'19h30',
            'day'=>'Mardi'
        ) ;

        return $lesson;
    }

    static function generate_family(){
        $family = array(
            'name'=>'family_name',
            'tel_1'=>'4189999999',
            'email'=>'okay@gmail.com',
            'address'=>'2020 du finfin'
        ) ;

        return $family;
    }

    static function generate_family_2(){
        $family = array(
            'name'=>'second_family_name',
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
            'date_of_birth'=>'1955-08-31 23:45:00',
            'sex'=>Sex::MEN,
            'role'=>Role::PARENT);
        return $family_member;
    }

    static function generate_children_family_member($family_id){
        $family_member = array(
            'family_id'=>$family_id,
            'name'=>'Rory',
            'date_of_birth'=>'2000-08-31 23:05:00',
            'sex'=>Sex::WOMEN,
            'role'=>Role::CHILD);
        return $family_member;
    }

    static function generate_join_family_member_lesson(){
        $lesson = TestData::generate_lesson();
        $my_lesson = new Lesson($lesson);
        $my_lesson->save();

        $family = TestData::generate_family();
        $my_family = new Family($family);
        $my_family->save();

        $family_member = TestData::generate_parent_family_member($my_family->family_id);
        $my_family->family_members = new FamilyMember($family_member);
        $my_family->save();

        $my_family_member = $my_family->family_members[0];

        return array('family_member_id'=>$my_family_member->family_member_id,
        'lesson_id'=>$my_lesson->lesson_id);

    }

}