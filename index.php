<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:25 PM
 */

include_once('db_credentials.php');
include_once('app_include.php');
include_once('constants.php');
include_once('route_description.php');

?>


<link rel="STYLESHEET" type="text/css" href="./ressource/css/style.css">
<link rel="STYLESHEET" type="text/css" href="./ressource/css/color_code.css">

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<table width="1400">
    <tr>
        <td width="250" valign="top"><?php include('menu.php'); ?><br><?php include('confirmation.php') ?></td>
        <td width="1150" valign="top"><?php include('route.php'); ?> </td>
    </tr>
</table>



