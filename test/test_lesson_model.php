<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-24
 * Time: 9:42 PM
 */


require_once('../app/model/lesson.php');
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
        $this->assertEquals($my_lesson->time,'Mardi 19h30');
    }

    function test_adding_new_family_in_db(){

        $lesson = TestData::generate_lesson();
        $my_lesson = new Lesson($lesson);
        $my_lesson->save();

        $my_retrieved_lesson = Lesson::last();
        $this->assertEquals($my_retrieved_lesson->session,'Hiver 2016');
        $this->assertEquals($my_retrieved_lesson->pool,'Limoilou');
        $this->assertEquals($my_retrieved_lesson->instructor,'Richard Bernier');
        $this->assertEquals($my_retrieved_lesson->time,'Mardi 19h30');

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

}