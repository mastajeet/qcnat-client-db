<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 11:54 AM
 */
include_once('base_model.php');

class Lesson extends BaseModel
{

    #### lesson info ####

    public $lesson_id;
    public $pool;
    public $day;
    public $time;
    public $level;
    public $session;
    public $instructor;
    public $inscriptions;


    static function define_data_types()
    {
        return array(
            'lesson_id' => 'ID',
            'pool' => 'string',
            'session' => 'string',
            'instructor' => 'string',
            'day' => 'string',
            'time' => 'string',
        );
    }

    static function define_table_info()
    {
        return array(
            'model_table' => "lesson",
            'model_table_id' => "lesson_id");
    }

    static function is_lesson_in_db($session, $pool, $day, $time, $level)
    {
        $req = "SELECT * FROM lesson WHERE session='" . $session . "' and pool='" . $pool . "' and day='" . $day . "' and time='" . $time . "' and level='" . $level . "'";
        $table_info = self::define_table_info();
        $rep = self::select($req);
        if (!$rep) {
            return false;
        }
        return ($rep[0][$table_info['model_table_id']]);
    }

    static function get_all_sessions()
    {
        $table_info = self::define_table_info();
        $req = "SELECT distinct(session), max(". $table_info['model_table_id'].") as m FROM lesson GROUP BY session ORDER BY m DESC";
        self::select($req);
        $ret = [];
        foreach (self::select($req) as $elem) {
            $ret[$elem['session']] = null;
        }
        return ($ret);
    }

    static function get_all_pools($session="")
    {
        if($session!=""){
            $req = "SELECT distinct(pool) FROM lesson WHERE session='" . $session . "' ORDER BY pool DESC";
        }else{
            $req = "SELECT distinct(pool) FROM lesson WHERE 1";
        }

        $ret = [];
        foreach (self::select($req) as $elem) {
            $ret[$elem['pool']] = null;
        }
        return ($ret);
    }

    static function get_all_days($session="", $pool="")
    {
        $table_info = self::define_table_info();
        if($session!="" and $pool!=""){
            $req = "SELECT distinct(day) FROM lesson WHERE session='" . $session . "' and pool='" . $pool . "' ORDER BY " . $table_info['model_table_id'] . " DESC";
        }else{
            $req = "SELECT distinct(day) FROM lesson WHERE 1";
        }

        $ret = [];
        foreach (self::select($req) as $elem) {
            $ret[$elem['day']] = null;
        }
        return ($ret);
    }

    static function get_all_lessons($session=Null, $pool=Null, $level=Null, $day = Null, $time = Null)
    {
        $table_info = self::define_table_info();
        if (is_null($time) and is_null($day)) {

            $session_filter = !is_empty_string($session)  ? " and session='".$session."'" : "";
            $pool_filter = !is_empty_string($pool)  ? " and pool='".$pool."'" : "";

            if(is_array($level)){
                $level_filter = " and ".convert_array_into_or_clause('level',$level);
            }elseif(is_empty_string($level)){
                $level_filter = "";
            }else{
                $level_filter = " and level='".$level."'";
            }


            $req = "SELECT " . $table_info['model_table_id'] . " FROM lesson WHERE 1 ".$session_filter.$pool_filter.$level_filter."  ORDER BY pool ASC, time ASC";

            $lessons= [];
            foreach(self::select($req) as $lesson){
                $lessons[$lesson[$table_info['model_table_id']]] = New Lesson($lesson[$table_info['model_table_id']]);
            }
            return($lessons);
        } else {
            throw new NotImplementedException(EXCEPTION_CANNOT_SPLIT_LESSON_BY_TIME);
        }
    }

    public function get_all_family_members()
    {
        if ($this->lesson_id <> "") {
            # sessions need to be sorted by timestamp....
            $join_info = JoinFamilyMemberLesson::define_table_info();
            $lesson_info = self::define_table_info();
            $family_member_info = FamilyMember::define_table_info();
            $req = "SELECT " . $family_member_info['model_table_id'] . " FROM " . $join_info['model_table'] . " WHERE " . $lesson_info['model_table_id'] . " = " . $this->lesson_id;
            $rep = self::select($req);
            $family_members = array();
            if ($rep) {
                foreach ($rep as $values) {
                    $family_members[] = new FamilyMember(($values[$family_member_info['model_table_id']]));
                }
            }
        } else {
            $family_members = [];
        }
        $this->family_members = $family_members;
    }

    public function get_all_inscriptions()
    {
        if ($this->lesson_id <> "") {
            # sessions need to be sorted by timestamp....
            $join_info = JoinFamilyMemberLesson::define_table_info();
            $lesson_info = self::define_table_info();
            $req = "SELECT " . $join_info['model_table_id'] . " FROM " . $join_info['model_table'] . " WHERE " . $lesson_info['model_table_id'] . " = " . $this->lesson_id;
            $rep = self::select($req);
            $join_family_member_lesson = array();
            if ($rep) {
                foreach ($rep as $values) {
                    $join_family_member_lesson[] = new JoinFamilyMemberLesson($values[$join_info['model_table_id']]);
                }
            }
        } else {
            $join_family_member_lesson = [];
        }

        $this->inscriptions = $join_family_member_lesson;
    }

    public function to_string()
    {
        return $this->session . " - " . $this->pool . " - " . $this->level . "  " . $this->day . " " . $this->time . " (" . $this->instructor . ")";
    }
}