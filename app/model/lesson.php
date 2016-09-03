<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 11:54 AM
 */
include_once('/base_model.php');
class cours extends base_model{

    #### cours Info ####

    public $pool;
    public $level;
    public $session;
    public $instructor;


    static function define_data_types()
    {
        return array(
            'cours_id' => 'ID',
            'family_members'=>'has_many',
            'name' => 'string',
            'tel_1' => 'string',
            'tel_2' => 'string',
            'address' => 'string',
            'email' => 'string',
            'created_at' => 'date',
            'deleted_at' => 'date'
        );
    }

    static function define_table_info(){
        return array(
            'model_table' =>"family",
            'model_table_id'=> "family_id");
    }
}