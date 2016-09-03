<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:26 PM
 */

function get_route($name,$args=null){

    switch ($name){

        CASE "add_family":
            return 'index.php?ressource=family&add=true';

        CASE "edit_family":
            return 'index.php?ressource=family&ID='.$args.'&edit=true';

        CASE "display_family":
            return 'index.php?ressource=family&ID='.$args;

        CASE "edit_family_member":
            return 'index.php?ressource=family_member&ID='.$args.'&edit=true';

        CASE "delete_family_member":
            return 'index.php?ressource=family_member&ID='.$args.'&delete=true';

        CASE "add_family_member":
            return 'index.php?ressource=family_member&add=true';


    }
    throw new UnexpectedValueException(NO_ROUTE.": ".$name);
}

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_POST['ressource'])){
        switch($_POST['ressource']) {

            CASE 'family': {
                $controller = new family_controller();
                break;
            }

            CASE 'family_member': {
                $controller = new family_member_controller();
                break;
            }
        }

        if(isset($controller)){

            $controller->post($_REQUEST);

        }
    }
}

if($_SERVER['REQUEST_METHOD']=='GET'){
  if(isset($_GET['ressource'])){
      switch($_GET['ressource']) {

          CASE 'family': {
              $controller = new family_controller();
              break;
          }

          CASE 'family_member': {
              $controller = new family_member_controller();
              break;
          }
      }

      if(isset($controller)){
          $filter = null;
          if(!isset($_GET['ID'])){
              if(!isset($_GET['add']))
                $controller->get_list($filter);
              else{
                  $controller->create_one($filter);
              }
          }else{
              if(isset($_GET['edit'])){
                  $controller->edit_one($_GET['ID']);
              }elseif(isset($_GET['delete'])) {
                  $controller->delete_one($_GET['ID']);
              }else{
                  $controller->get_one($_GET['ID']);
              }

          }


      }
  }
}