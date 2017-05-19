<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 18/05/17
 * Time: 3:44 PM
 */
include_once ('app_include.php');
include_once('db_credentials.php');
switch ($_GET['ressource']){

    CASE "family":
        $family_tel_1 = str_replace(["(",")","-"," "],"", $_GET['tel1']);
        $retrived_family_member = Family::find_by("tel_1",$family_tel_1);
        if($retrived_family_member==[]){
            $retrived_family_member = Family::find_by("tel_2",$family_tel_1);
            if($retrived_family_member==[]){
                print_r([]);
            }else{
                print_r($retrived_family_member[0]->to_json());
            }
        }else{
            print_r($retrived_family_member[0]->to_json());
        }
        BREAK;

}