<?php
/**
 * Created by PhpStorm.
 * User: mastajeet
 * Date: 17-02-15
 * Time: 21:39
 */

function generate_from_add_family_member_to_lesson($request_data){


    $family_name = $request_data['FORM_Family_name'];
    $family_member_lastname= $request_data['FORM_Family_name'];
    $family_tel_1= $request_data['FORM_Family_tel_1'];
    $family_member_name= $request_data['FORM_Family_member_name'];

    $family_tel_1 = str_replace(["(",")","-"," "],"", $family_tel_1);

    $retrived_family_member = Family::find_by("tel_1",$family_tel_1);
    if(count($retrived_family_member)==0){
        $family = new Family([
                'name'=>$family_name,
                'tel_1'=> $family_tel_1
        ]);
        $family->save();
    }elseif(count($retrived_family_member)==1){
        $family = $retrived_family_member[0];
    }else{
        throw new Exception(EXCEPTION_TOO_MANY_FAMILIES_FOUND);
    }

    $family->get_family_members();
    $member_found = false;

    foreach($family->family_members as $family_member){
        if($family_member->name == $family_member_name){
            $member_found = true;
            break;
        }
    }

    if(!$member_found){
        $family_member = New FamilyMember(
            [
                'name'=>$family_member_name,
                'lastname'=>$family_member_lastname,
                'family_id'=>$family->family_id,
            ]
        );
        $family_member->save();
    }

    $lesson_taken = New JoinFamilyMemberLesson(
        [
            'lesson_id' => $request_data["lesson_id"],
            'family_member_id' => $family_member->family_member_id,
            'prefix' => $request_data["FORM_Prefix"]
        ]
    );
    $lesson_taken->save();
    
}