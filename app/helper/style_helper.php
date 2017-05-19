<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 19/05/17
 * Time: 10:20 AM
 */

function alternate_row_style($actual){
    if($actual=="one"){
        return "two";
    }elseif($actual=="two"){
        return "one";
    }

}