<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 12:07 PM
 */
include_once('base_model.php');
class TakenLesson extends BaseModel
{
    public $family_member_id;
    public $lesson_id;

    static function define_data_types()
    {
        return array(
            'join_lesson_family_member_id' => 'ID',
            'lesson_id' => 'ID',
            'family_member_id' => 'ID'
        );
    }

    static function define_table_info(){
        return array(
            'model_table' =>"join_lesson_family_member",
            'model_table_id'=> "join_lesson_family_member_id");
    }

    static function join($family_member, $lesson)
    {
        $join = new self(array('family_member_id'=>$family_member->family_member_id,'lesson_id'=>$lesson->lesson_id));
        $join->save();

        return $join;

    }
}