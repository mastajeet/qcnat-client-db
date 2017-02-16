<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-13
 * Time: 11:32 PM
 */

function get_route($name,$args=null){
    if(!is_array($args)){
        $args[0] = $args;
    }
    switch ($name){

        CASE "add_family":
            return 'index.php?ressource=family&add=true';

        CASE "edit_family":
            return 'index.php?ressource=family&ID='.$args[0].'&edit=true';

        CASE "display_family":
            return 'index.php?ressource=family&ID='.$args[0];

        CASE "display_families":
            return 'index.php?ressource=family&order_by=name&order=ASC';

        CASE "edit_family_member":
            return 'index.php?ressource=family_member&ID='.$args[0].'&edit=true';

        CASE "delete_family_member":
            return 'index.php?ressource=family_member&ID='.$args[0].'&delete=true';

        CASE "add_family_member":
            return 'index.php?ressource=family_member&add=true';

        CASE "remove_join_lesson_family_member":
            return 'index.php?ressource=family_member&action=remove_lesson&family_member_id='.$args[0].'&lesson_id='.$args[1];

    }
    throw new UnexpectedValueException(NO_ROUTE.": ".$name);
}