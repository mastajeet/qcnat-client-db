<?php
/**
 * Created by PhpStorm.
 * User: mastajeet
 * Date: 17-03-05
 * Time: 15:25
 */


$output = new HTMLHelper();

$output->addform(SELECT_LESSON,'index.php',"GET","");
$output->inputhidden_env('ressource','lesson');
$output->inputhidden_env('edit','true');
$lesson_info = Lesson::define_table_info();

$options = array();
foreach ($lessons as $lesson) {
    $option[$lesson->{$lesson_info['model_table_id']}] = $lesson->to_string();
}

$output->inputselect('ID', $option,NULL,LESSON);
$output->formsubmit(SELECT);

echo $output->send(1);


