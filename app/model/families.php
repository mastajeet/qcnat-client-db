<?php
include_once('sql_helper.php');
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:53 PM
 */
class families
{
    public $inner_list;

    function __construct(){
        $this->get_inner_list();
    }

    function get_inner_list($sorted_by="name", $orientation = "ASC", $number=1000, $page=1){

        $SQL = new SqlHelper();
        $this->inner_list = array();
        $req = "SELECT * FROM family WHERE 1 ORDER BY ".$sorted_by." ".$orientation." LIMIT ".($page-1)*$number.", ".($page)*$number;

        $SQL->select($req);
        while($rep = $SQL->fetcharray()){
            $this->inner_list[] = $rep;
        }

        $Req = "SELECT count(family_id) as total FROM family WHERE 1";
        $SQL->select($req);
        while($rep = $SQL->fetcharray()){
            return(ceil($rep['total']/$number));
        }

    }
}