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
    public $day;
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
            'day' => 'string',
            'time' => 'string',
        );
    }

    static function define_table_info(){
        return array(
            'model_table' =>"lesson",
            'model_table_id'=> "lesson_id");
    }

    static function is_lesson_in_db($session, $pool, $day, $time, $level){
        $req = "SELECT * FROM lesson WHERE session='".$session."' and pool='".$pool."' and day='".$day."' and time='".$time."' and level='".$level."'";
        $table_info = self::define_table_info();
        $rep = self::select($req);
        if(!$rep){
            return false;
        }
        return($rep[0][$table_info['model_table_id']]);
    }

    public function to_string(){
        return $this->session." - ".$this->pool." - ".$this->level."  ".$this->day." ".$this->time." (".$this->instructor.")";
    }
}