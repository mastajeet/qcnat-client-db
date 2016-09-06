<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:17 PM
 */


include_once('base_model.php');

class FamilyMember extends BaseModel
{
    #### INFO #####
    public $family_member_id;
    public $name;
    public $date_of_birth;
    public $sex;
    public $role;
    public $family_id;
    protected $age;
    protected $last_course = null;
    protected $previous_courses = null;


    static function define_data_types()
    {
        return array(
            'family_member_id' => 'ID',
            'family_id=>'=>'ID',
            'previous_courses'=>'has_many',
            'last_course'=>'has_one',
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

    public function age(){
        return 12;
        #find a age function somewhere on the internet....
    }

    public function get_previous_courses(){
        # sessions need to be sorted by timestamp....

    }

    public function get_last_course(){
        if(is_null($this->previous_courses)){
            $this->get_previous_courses();
        }
        return $this->previous_courses[len($this->previous_courses-1)];
    }

}
