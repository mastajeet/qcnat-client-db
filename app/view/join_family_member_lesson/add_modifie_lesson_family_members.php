<script>
    function myBlurFunction() {
        var x = document.getElementById("family_name");
        document.getElementById("family_member_lastname").value = x.value;
    }

    function correct_phone_input() {

        var x = document.getElementById("family_tel_1");

        var str = x.value;
        str = str.replace("(","");
        str = str.replace(" ","");
        str = str.replace(")","");
        str = str.replace(".","");
        str = str.replace("-","");
        str = str.replace("_","");

        if(str.length==7){
            str = '(<?php print(DEFAULT_REGIONAL_CODE) ?>) '+str.slice(0,3) +'-'+ str.slice(3,7) ;
        }

        if(str.length==10){

           str = '('+str.slice(0,3)+') '+ str.slice(3,6)+'-'+ str.slice(6,10) ;
        }

        document.getElementById("family_tel_1").value = str;

    }


</script>

<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2017-02-15
 * Time: 9:01 AM
 */

$output = new HTMLHelper();
$next_id = ($lesson->lesson_id)+1;
$current_session =$lesson->session;
$current_pool = $lesson->pool;

$uri_filter = "&filter[pool]=".$current_pool."&filter[session]=$current_session ";

$output->addpic('ressource/icon/home.png','','index.php?ressource=join_family_member_lesson&action=obtain_cahier'.$uri_filter .'&ID='.$lesson_id);
$output->addpic('ressource/icon/refresh.png','','index.php?ressource=join_family_member_lesson&edit=true&ID='.$lesson_id);
$output->addpic('ressource/icon/next_ressource.png','','index.php?ressource=join_family_member_lesson&edit=true&ID='.$next_id);
$output->addtexte(ucfirst(LESSON_ADD_FAMILY_MEMBER), 'titre');

$output->opentable($width = 670);

$output->add_tabular_data(LESSON_POOL, $lesson->pool);
$output->add_tabular_data(LESSON_DAY, $lesson->day);
$output->add_tabular_data(LESSON_TIME, $lesson->time);
$output->add_tabular_data(LESSON_LEVEL, $lesson->level);
$output->add_tabular_data(LESSON_INSTRUCTOR, $lesson->instructor);
$output->hr(2);
$output->closetable();

$output->opentable($width = 670);


$output->openrow();

$output->opencol(20);
$output->addtexte(" ");
$output->closecol();


$output->opencol(20);
$output->addtexte(" ");
$output->closecol();


$output->opencol(150);
$output->addtexte(ucfirst(FAMILY),'titre');
$output->closecol();


$output->opencol(150);
$output->addtexte(ucfirst(FIRSTNAME),'titre');
$output->closecol();


$output->opencol(150);
$output->addtexte(ucfirst(TELEPHONE),'titre');
$output->closecol();

$output->opencol(150);
$output->addtexte(ucfirst(PREFIX),'titre');
$output->closecol();

$output->opencol(50);
$output->addtexte(" ");
$output->closecol();

$output->closerow();

$family_member_index = 1;
foreach ($lesson->inscriptions as $inscription) {
    $output->openrow();
    $family_member = $inscription->family_member;


    $output->opencol();
    $output->addlink(get_route('delete_join_family_member',$inscription->join_family_member_lesson_id),"x");
    $output->closecol();


    $output->opencol(20);
    $output->addtexte($family_member_index);
    $output->closecol();

    $output->opencol();
    $output->addtexte($family_member->family->name);
    $output->closecol();


    $output->opencol();
    $output->addtexte($family_member->name);
    $output->closecol();


    $output->opencol();
    $output->addphone($family_member->family->tel_1);
    $output->closecol();


    foreach($family_member->previous_lessons as $lesson){
        if($lesson->lesson_id == $lesson->lesson_id){
            $output->opencol();
            $output->addtexte($lesson->prefix);
            $output->closecol();

        }
    }


    $output->opencol();
    $output->addtexte(" ");
    $output->closecol();

    $output->closerow();
    $family_member_index++;
}


$output->addoutput("<form action=index.php method=POST>");
$output->addoutput("<input hidden name=action value=nested_insert>");
$output->addoutput("<input hidden name=ressource value='family'>");
$output->addoutput("<input hidden name=lesson_id value='".$lesson->lesson_id."'>");
$output->openrow();

$output->opencol();
$output->addoutput(" ");
$output->closecol();


$output->opencol();
$output->addoutput($family_member_index);
$output->closecol();


$output->opencol();
$output->addoutput("<input text name=FORM_Family_name id='family_name'>");
$output->closecol();


$output->opencol();
$output->addoutput("<input text name=FORM_Family_member_name>");
$output->closecol();

$output->opencol();
$output->addoutput("<input text name=FORM_Family_tel_1 id='family_tel_1' onblur=correct_phone_input()>");
$output->closecol();


$output->opencol();
$output->addoutput("<input text name=FORM_Prefix >");
$output->closecol();


$output->opencol();
$output->addoutput("<input type=submit value=".ACTION_ADD.">");
$output->closecol();


$output->closerow();

print($output->send(1));