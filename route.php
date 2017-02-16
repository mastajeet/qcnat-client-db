<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:26 PM
 */
//print_r($_REQUEST);


if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_POST['ressource'])){
        switch($_POST['ressource']) {

            CASE 'family': {
                $controller = new FamilyController();
                break;
            }

            CASE 'family_member': {
                $controller = new FamilyMemberController();
                break;
            }

            CASE 'join_family_member_lesson': {
                $controller = new JoinFamilyMemberLessonController();
                break;
            }

        }

        if(isset($controller)){

            if(isset($_POST['action'])) {
                $function_name = $_POST['action'];
                $controller->$function_name($_REQUEST);
            }else{
            $controller->post($_REQUEST);
            }
        }
    }
}

if($_SERVER['REQUEST_METHOD']=='GET'){
  if(isset($_GET['ressource'])){
      switch($_GET['ressource']) {

          CASE 'family': {
              $controller = new FamilyController();
              break;
          }

          CASE 'family_member': {
              $controller = new FamilyMemberController();
              break;
          }

          CASE 'lesson': {
              $controller = new LessonController();
              break;
          }

          CASE 'join_family_member_lesson': {
              $controller = new JoinFamilyMemberLesson();
              break;
          }
      }

      if(isset($controller)){



          $args = $_GET;
          if(isset($_GET['action'])){
              $function_name = $_GET['action'];
              $controller->$function_name();
          }else{

              if (!isset($_GET['ID'])) {
                  if (!isset($_GET['add'])) {
                      $filter = isset($_GET['filter']) ? $_GET['filter'] : FILTER;
                      $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : ORDER_BY;
                      $order = isset($_GET['order']) ? $_GET['order'] : ORDER;
                      $nb_per_page = isset($_GET['nb_per_page']) ? $_GET['nb_per_page'] :NB_PER_PAGE;
                      $page = isset($_GET['page']) ? $_GET['page'] : PAGE;
                      $controller->get_list($filter, $order_by, $order,$nb_per_page, $page);
                  }
                  else {
                      $controller->create_one($args);
                  }
              } else {
                  if (isset($_GET['edit'])) {
                      $controller->edit_one($_GET['ID']);
                  } elseif (isset($_GET['delete'])) {
                      $controller->delete_one($_GET['ID']);
                  } else {
                      $controller->get_one($_GET['ID']);
                  }

              }
          }

      }
  }else{

  }
}