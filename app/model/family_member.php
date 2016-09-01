<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:17 PM
 */

class sex{
    const MEN = 1;
    const WOMEN = 2;
}

class role{
    const PARENT = 1;
    const CHILD = 2;
}
include_once('base_model.php');

class family_member extends base_model
{
    #### INFO #####
    public $family_member_id;
    public $name;
    public $date_of_birth;
    public $sex;
    public $role;
    protected $family_id;


    static function define_data_types()
    {
        return array(
            'family_member_id' => 'ID',
            'family_id=>'=>'ID',
            'name'=>'string',
            'date_of_birth'=>'date',
            'sex'=>'int',
            'role'=>'int');

    }

    static function define_table_info(){
        return array(
            'model_table' => "family_member",
            'model_table_id' => "family_member_id");
    }


}