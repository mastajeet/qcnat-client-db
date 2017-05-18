<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 18/05/17
 * Time: 10:56 AM
 */

foreach(LessonLevel::get_lession_level_list() as $key=>$value){
    $level_list[$value] = $value;
}

$output = new HTMLHelper();

$output->addform(SEARCH_LESSON,'index.php','GET',"");
$output->inputhidden_env('action','search');
$output->inputhidden_env('ressource','lesson');

$output->inputselect('filter[session]',Lesson::get_all_sessions(),$search_criteria['session'],SESSION);
$output->inputselect('filter[pool]',Lesson::get_all_pools(),$search_criteria['pool'],POOL);
$output->inputselectmultiple('filter[level][]',$level_list,$search_criteria['level'],LEVEL);
$output->formsubmit(SEARCH);

echo $output->send(1);


