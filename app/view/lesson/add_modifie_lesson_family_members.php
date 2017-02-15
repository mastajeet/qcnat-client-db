<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2017-02-15
 * Time: 9:01 AM
 */

$output = new HTMLHelper();
$output->addtexte(ucfirst(LESSON_ADD_FAMILY_MEMBER),'titre');

$output->opentable($width=750);

$output->add_tabular_data(LESSON_POOL,$lesson->pool);
$output->add_tabular_data(LESSON_DAY,$lesson->day);
$output->add_tabular_data(LESSON_TIME,$lesson->time);
$output->add_tabular_data(LESSON_LEVEL,$lesson->level);
$output->add_tabular_data(LESSON_INSTRUCTOR,$lesson->instructor);
$output->hr(2);
$output->closetable();

foreach($lesson->family_members as $family_member){

}


print($output->send(1));