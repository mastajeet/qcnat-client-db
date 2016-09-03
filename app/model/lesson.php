<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 11:54 AM
 */
include_once('/base_model.php');
class Lesson extends BaseModel{

    #### lesson info ####

    public $lesson_id;
    public $pool;
    public $time;
    public $level;
    public $session;
    public $instructor;


    static function define_data_types()
    {
        return array(
            'lesson_id' => 'ID',
            'pool'=>'string',
            'session' => 'string',
            'instructor' => 'string',
            'time' => 'string'
        );
    }

    static function define_table_info(){
        return array(
            'model_table' =>"lesson",
            'model_table_id'=> "lesson_id");
    }
}