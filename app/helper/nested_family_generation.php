<?php
/**
 * Created by PhpStorm.
 * User: mastajeet
 * Date: 17-02-15
 * Time: 21:39
 */

function generate_from_add_family_member_to_lesson($request_data){


    $family_name = $request_data['FORM_Family_name'];
    $family_member_lastname= $request_data['FORM_Family_member_lastname'];
    $family_tel_1= $request_data['FORM_Family_tel_1'];
    $family_member_name= $request_data['FORM_Family_member_name'];

    $retrived_family_member = Family::find_by("tel_1",$family_tel_1);
    if(count($retrived_family_member)==0){
        //famille n'existe pas, creer avec un array;
        $Family = new Family();
    }elseif(count($retrived_family_member)==1){
        $Family = $retrived_family_member[0];
    }else{
        throw new Exception(EXCEPTION_TOO_MANY_FAMILIES_FOUND);
    }


    //print_r($retrived_family_member);

}