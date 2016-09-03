<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 12:07 PM
 */
include_once('base_model.php');
class JoinFamilyMemberLesson extends BaseModel
{
    public $join_family_member_lesson_id;
    public $family_member_id;
    public $lesson_id;

    static function define_data_types()
    {
        return array(
            'join_family_member_lesson_id' => 'ID',
            'lesson_id' => 'int',
            'family_member_id' => 'int'
        );
    }

    static function define_table_info(){
        return array(
            'model_table' =>"join_family_member_lesson",
            'model_table_id'=> "join_family_member_lesson_id");
    }

    static function join($family_member, $lesson)
    {
        $join = new self(array('family_member_id'=>$family_member->family_member_id,'lesson_id'=>$lesson->lesson_id));
        $join->save();

        return $join;

    }
}