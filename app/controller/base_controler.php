<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:39 PM
 */
class base_controler
{
    protected $controlled_model;

    function get_one($ID){
        throw new NotImplementedException("No Model is specified");
    }

    function get_list($filters){
        throw new NotImplementedException("No Model is specified");
    }

    function edit_one($ID){
        throw new NotImplementedException("No Model is specified");
    }

    function create_one(){
        throw new NotImplementedException("No Model is specified");
    }

    function delete_one($ID){
        throw new NotImplementedException("No Model is specified");
    }

}