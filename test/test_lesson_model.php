<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-24
 * Time: 9:42 PM
 */


require_once('../app/model/lesson.php');
require_once('../app/model/join_family_member_lesson.php');
require_once('../app/helper/MySQLHelper.php');
require_once('../db_credentials.php');
require_once('../constants.php');
require_once('test_data.php');

class TestLessonModel extends PHPUnit_Framework_TestCase
{




    function test_creating_new_family(){

        $lesson = TestData::generate_lesson();
        $my_lesson = new Lesson($lesson);
        $this->assertEquals($my_lesson->session,'Hiver 2016');
        $this->assertEquals($my_lesson->pool,'Limoilou');
        $this->assertEquals($my_lesson->instructor,'Richard Bernier');
        $this->assertEquals($my_lesson->day,'Mardi');
        $this->assertEquals($my_lesson->time,'19h30');
    }

    function test_adding_new_family_in_db(){

        $lesson = TestData::generate_lesson();
        $my_lesson = new Lesson($lesson);
        $my_lesson->save();

        $my_retrieved_lesson = Lesson::last();
        $this->assertEquals($my_retrieved_lesson->session,'Hiver 2016');
        $this->assertEquals($my_retrieved_lesson->pool,'Limoilou');
        $this->assertEquals($my_retrieved_lesson->instructor,'Richard Bernier');
        $this->assertEquals($my_retrieved_lesson->day,'Mardi');
        $this->assertEquals($my_retrieved_lesson->time,'19h30');

    }

    function test_modify_family_in_db(){

        $lesson = TestData::generate_lesson();
        $my_lesson = new Lesson($lesson);
        $my_lesson->save();

        $my_retrieved_lesson = Lesson::last();
        $this->assertEquals('Limoilou',$my_retrieved_lesson->pool);

        $my_retrieved_lesson->pool = 'Plaza Laval';
        $my_retrieved_lesson->save();

        $my_retrieved_lesson_2 = Lesson::last();
        $this->assertEquals('Plaza Laval',$my_retrieved_lesson_2->pool);

    }

    function test_list_family_member_in_course(){

        $lesson = TestData::generate_join_family_member_lesson();
        $my_join = new JoinFamilyMemberLesson($lesson);
        $my_join->save();

        $my_retrieved_join = JoinFamilyMemberLesson::last();

        $my_lesson = new Lesson($my_retrieved_join->lesson_id);
        $my_lesson->get_all_family_members();
        $this->assertEquals(count($my_lesson->family_members),1);

    }

}