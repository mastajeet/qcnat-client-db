<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 16/05/17
 * Time: 11:43 AM
 */


foreach(LessonLevel::get_lession_level_list() as $key=>$value){
    $level_list[$value] = $value;
}


$output = new HTMLHelper();

$output->addform(ADD_MODIFY_FAMILY);

$output->inputhidden_env('ressource','lesson');
$output->inputhidden('lesson_id',$lesson->lesson_id);

$output->inputselect('session',Lesson::get_all_sessions(),$lesson->session,SESSION);
$output->inputselect('pool',Lesson::get_all_pools(),$lesson->pool,POOL);
$output->inputselect('day',Lesson::get_all_days(),$lesson->day,DAY);
$output->inputtext('time',TIME,28,$lesson->time);
$output->inputselect('level',$level_list,$lesson->level,LEVEL);
$output->inputtext('instructor',INSTRUCTOR,28,$lesson->instructor);

$output->formsubmit(ADD_MODIFY);

echo $output->send(1);