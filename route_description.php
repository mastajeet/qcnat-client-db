<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-13
 * Time: 11:32 PM
 */

function get_route($name,$args=null){

    $lambda_args_function = args_parser_lambda($args);

    switch ($name){

        CASE "add_family":
            return 'index.php?ressource=family&add=true';

        CASE "edit_family":
            return 'index.php?ressource=family'.$lambda_args_function('ID').'&edit=true';

        CASE "display_family":
            return 'index.php?ressource=family'.$lambda_args_function('ID');

        CASE "display_families":
            return 'index.php?ressource=family&order_by=name&order=ASC';

        CASE "edit_family_member":
            return 'index.php?ressource=family_member'.$lambda_args_function('ID').'&edit=true';

        CASE "delete_family_member":
            return 'index.php?ressource=family_member'.$lambda_args_function('ID').'&delete=true';

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

        CASE "search_lesson":
            return 'index.php?ressource=lesson&action=search'.$lambda_args_function('filter').'';

        CASE "delete_join_family_member":
            return 'index.php?ressource=join_family_member_lesson&delete=True'.$lambda_args_function('ID').'&ToConfirm=True';


    }
    throw new UnexpectedValueException(NO_ROUTE.": ".$name);
}