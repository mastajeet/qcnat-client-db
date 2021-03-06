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
    public $lastname;
    public $date_of_birth;
    public $sex;
    public $role;
    public $family_id;
    protected $age;
    protected $last_lesson = null;
    protected $previous_lessons = null;
    protected $previous_inscriptions = null;


    static function define_data_types()
    {
        return array(
            'family_member_id' => 'ID',
            'family_id=>'=>'ID',
            'previous_lessons'=>'has_many',
            'last_lesson'=>'has_one',
            'name'=>'string',
            'lastname'=>'string',
            'date_of_birth'=>'date',
            'sex'=>'int',
            'role'=>'int');
    }

    static function define_default_values()
    {
        $return_array =[
            'date_of_birth'=>"1970-01-01 00:00:00",
            'sex'=>'0',
            'role'=>'0',
        ];
        return $return_array;
    }


    static function define_table_info(){
        return array(
            'model_table' => "family_member",
            'model_table_id' => "family_member_id");
    }

    public function age(){
        if($this->date_of_birth!=0 and $this->date_of_birth!="1970-01-01 00:00:00"){
            $date_of_birth = new DateTime();
            $date_of_birth->setTimestamp(strtotime($this->date_of_birth));
            $today = new DateTime();
            $today->setTimestamp(time());
            $diff = $today->diff($date_of_birth);
            return $diff->y;
        }

        #find a age function somewhere on the internet....
    }

    public function get_previous_lessons(){
        if($this->family_member_id<>""){
            # sessions need to be sorted by timestamp....
            $join_info = JoinFamilyMemberLesson::define_table_info();
            $lesson_info = Lesson::define_table_info();
            $family_member_info = self::define_table_info();
            $req = "SELECT ".$lesson_info['model_table_id'].",".$join_info['model_table_id'].", prefix FROM ".$join_info['model_table']." WHERE ".$family_member_info['model_table_id']." = ".$this->family_member_id;
            $rep = self::select($req);
            $previous_lesson = array();
            if($rep){
                foreach($rep as $values){
                    $current_lesson = new Lesson(($values[$lesson_info['model_table_id']]));
                    $current_lesson->join_id = ($values[$join_info['model_table_id']]);
                    $current_lesson->prefix =  ($values['prefix']);
                    $previous_lesson[] = $current_lesson;
                }
            }
        }else{
            $previous_lesson = [];
        }
        $this->previous_lessons = $previous_lesson;
    }

    private function obtain_previous_inscriptions(){
        if($this->family_member_id<>""){
            # sessions need to be sorted by timestamp....
            $join_info = JoinFamilyMemberLesson::define_table_info();
            $lesson_info = Lesson::define_table_info();
            $family_member_info = self::define_table_info();
            $req = "SELECT ".$join_info['model_table_id']." FROM ".$join_info['model_table']." WHERE ".$family_member_info['model_table_id']." = ".$this->family_member_id;
            $rep = self::select($req);
            $previous_inscriptions = array();
            if($rep){
                foreach($rep as $values){

                    $current_inscription = new JoinFamilyMemberLesson($values[$join_info['model_table_id']]);
                    $previous_inscriptions[] = $current_inscription;
                }
            }
        }else{
            $previous_inscriptions = [];
        }
        $this->previous_inscriptions = $previous_inscriptions;
    }

    public function get_family(){
        if($this->family_id<>""){
            $this->family = new Family($this->family_id);
        }
    }

    public function get_last_lesson(){
        if(is_null($this->previous_lessons)){
            $this->get_previous_lessons();
        }

        if(count($this->previous_lessons)>0){
            $this->last_lesson = $this->previous_lessons[count($this->previous_lessons)-1]->to_string();
        }
    }

    public function get_previous_inscriptions(){
        if(is_null($this->previous_inscriptions)){
            $this->obtain_previous_inscriptions();
        }
        return $this->previous_inscriptions;
    }


}
