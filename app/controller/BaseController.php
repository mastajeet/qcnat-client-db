<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:39 PM
 */
class BaseController
{
    protected $controlled_model;

    function get_one($ID){
        throw new NotImplementedException("No Model is specified");
    }

    function get_list($filter, $order_by, $order,$nb_per_page, $page){
        throw new NotImplementedException("No Model is specified");
    }

    function edit_one($ID){
        throw new NotImplementedException("No Model is specified");
    }

    function create_one($args){
        throw new NotImplementedException("No Model is specified");
    }

    function delete_one($ToConfirm, $ID){
        throw new NotImplementedException("No Model is specified");
    }

}