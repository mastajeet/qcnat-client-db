<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-05
 * Time: 10:13 PM
 */

require_once('../app/helper/basic_enum.php');

class enum1 extends BasicEnum{
    const KEY1 = "VALUE1";
    const KEY2 = "VALUE2";

}


class TestBasicEnumHelper extends PHPUnit_Framework_TestCase
{

    function test_listing(){
        $this->assertEquals(enum1::get_constants(),array('KEY1'=>'VALUE1','KEY2'=>'VALUE2'));
    }



}