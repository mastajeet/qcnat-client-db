<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-24
 * Time: 9:42 PM
 */


require_once('../app/helper/post_request_preparer.php');

class TestArgsParserLambda extends PHPUnit_Framework_TestCase
{


    function test_creating_or_with_no_item(){
        $args  = [];
        $or_clause = convert_array_into_or_clause('field',$args);
        $this->assertEquals($or_clause,"(1)");
    }



    function test_creating_or_with_one_item(){
        $args  = [1=>'a'];
        $or_clause = convert_array_into_or_clause('field',$args);
        $this->assertEquals($or_clause,"(field='a')");
    }

    function test_creating_or_with_two_items(){
        $args  = [0=>'a',1=>'b'];
        $or_clause = convert_array_into_or_clause('field',$args);
        $this->assertEquals($or_clause,"(field='a' OR field='b')");
    }


}