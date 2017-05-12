<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 12/05/17
 * Time: 12:33 PM
 */


require_once ('../app/helper/lesson_level.php');

class testlessonlevelhelper extends PHPUnit_Framework_TestCase{
    function test_obtain_ordered_list(){
        $lesson_level_list = LessonLevel::get_lession_level_list();
        $this->assertEquals($lesson_level_list[0],'Etoile de mer');
        $this->assertEquals($lesson_level_list[35],'Bain Libre');

    }


}