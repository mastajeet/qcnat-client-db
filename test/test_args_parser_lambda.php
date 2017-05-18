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

    function test_creating_single_value_args(){
        $args = 12;
        $lambda_to_test = args_parser_lambda($args);
        $this->assertEquals($lambda_to_test('ID'),"&ID=12");
    }

    function test_creating_multi_values_args(){
        $args = [
            'a'=>1,
            'b'=>2,
        ];
        $lambda_to_test = args_parser_lambda($args);
        $this->assertEquals($lambda_to_test('ID'),"&ID[a]=1&ID[b]=2");
    }


}