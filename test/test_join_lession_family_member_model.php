<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 12:37 PM
 */

require_once('../app/model/lesson.php');
require_once('../app/model/family_member.php');
require_once('../app/model/join_family_member_lesson.php');
require_once('../app/helper/MySQLHelper.php');
require_once('../db_credentials.php');
require_once('../constants.php');

require_once('test_data.php');




class TestJoinFamilyMemberLesson extends PHPUnit_Framework_TestCase
{


    function test_creating_new_join(){


        $to_join = TestData::generate_join_family_member_lesson();
        $my_join = new JoinFamilyMemberLesson($to_join);

        $this->assertEquals($my_join->family_member_id,$to_join['family_member_id']);
        $this->assertEquals($my_join->lesson_id,$to_join['lesson_id']);

    }



    function test_adding_new_family_in_(){


        $to_join = TestData::generate_join_family_member_lesson();
        $my_join = new JoinFamilyMemberLesson($to_join);

        $my_join->save();


        $my_retrieved_join = JoinFamilyMemberLesson::last();
        $this->assertEquals($my_retrieved_join ->family_member_id,$to_join['family_member_id']);
        $this->assertEquals($my_retrieved_join ->lesson_id,$to_join['lesson_id']);


    }

    function test_link(){

        $to_join = TestData::generate_join_family_member_lesson();

        $my_join = JoinFamilyMemberLesson::join(
            new FamilyMember($to_join['family_member_id']),
            new Lesson($to_join['lesson_id'])
        );

        $my_retrieved_join = JoinFamilyMemberLesson::last();
        $this->assertEquals($my_retrieved_join ->family_member_id,$to_join['family_member_id']);
        $this->assertEquals($my_retrieved_join ->lesson_id,$to_join['lesson_id']);


    }


}







