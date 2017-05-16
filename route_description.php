<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-13
 * Time: 11:32 PM
 */

function get_route($name,$args=null){

    switch ($name){

        CASE "add_family":
            return 'index.php?ressource=family&add=true';

        CASE "edit_family":
            return 'index.php?ressource=family&ID='.$args.'&edit=true';

        CASE "display_family":
            return 'index.php?ressource=family&ID='.$args;

        CASE "display_families":
            return 'index.php?ressource=family&order_by=name&order=ASC';

        CASE "edit_family_member":
            return 'index.php?ressource=family_member&ID='.$args.'&edit=true';

        CASE "delete_family_member":
            return 'index.php?ressource=family_member&ID='.$args.'&delete=true';

        CASE "add_family_member":
            return 'index.php?ressource=family_member&add=true';

        CASE "display_lesson":
            return 'index.php?ressource=lesson';

        CASE "display_cahier":
            return 'index.php?ressource=join_family_member_lesson';

        CASE "obtain_cahier":
            return 'index.php?ressource=join_family_member_lesson&action=obtain_cahier';

        CASE "obtain_carton":
            return 'index.php?ressource=join_family_member_lesson&action=obtain_carton';

        CASE "add_lesson":
            return 'index.php?ressource=lesson&add=True';


    }
    throw new UnexpectedValueException(NO_ROUTE.": ".$name);
}