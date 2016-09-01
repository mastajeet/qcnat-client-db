<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 11:13 PM
 */

function prepare_post_request_data($post_data,$form_name="FORM"){

    $prepared_data = array();
    foreach($post_data as $key=>$value){
        $len_form_name = strlen($form_name);
        $date_to_convert = array();
        $phone_to_convert = array();

        if(substr($key,0,$len_form_name)==$form_name){


            if(substr($key,0,$len_form_name+1+4)==$form_name."_DATE"){
                $field_name = substr($key,$len_form_name+1+5,strlen($key-$len_form_name+8));
                if(!array_key_exist($field_name,$date_to_convert)){
                    $date_to_convert[$field_name] = array();
                }

                $date_to_convert[$field_name][substr($key,-1)] = $value;
            }elseif(substr($key,0,$len_form_name+1+5)==$form_name."_PHONE"){
                $field_name = substr($key,$len_form_name+1+6,strlen($key-$len_form_name+9));
                if(!array_key_exist($field_name,$phone_to_convert)){
                    $phone_to_convert[$field_name] = array();
                }

                $phone_to_convert[$field_name][substr($key,-1)] = $value;
            }else{
                $prepared_data[substr($key,$len_form_name+1)] = $value;
            }
        }
    }

    foreach($date_to_convert as $field_name=>$date_data){
        $prepared_data[$field_name] = convert_date_from_post_data($date_data);
    }

}


function convert_date_from_post_data($date_post_data_array){
    return mktime(0,0,0,$date_post_data_array[4],$date_post_data_array[5],$date_post_data_array[3]);
}

function convert_phone_from_post_data($phone_post_data_array){
    throw new NotImplementedException();
}