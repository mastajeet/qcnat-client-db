<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 10:09 PM
 */


const BD_CLIENTS = "Base de donnee de clients";

#### PAGINATION DEFAULT VALUES ####
const ORDER_BY = '1';
const ORDER  = '';
const FILTER = '1';
const NB_PER_PAGE = 50;
const PAGE = 0;

#### Family ####
const FAMILY = 'famille';
const NAME = 'nom';
const TELEPHONE = 'téléphone';
const EMAIL = 'email';
const ADDRESS = 'adresse';
const LASTCOURSE = 'dernier cours';
const DATE_OF_BIRTH = "date de naissance";
const ADD_MODIFY_FAMILY = "Ajouter / Modifier une famille";
const ADD_MODIFY = "Ajouter / Modifier";
const DISPLAY_FAMILIES = "Familles";
const INITIAL_ID = 1000;


#### FamilyMember ####
const ADD_MODIFY_FAMILY_MEMBER = "Ajouter / Modifier un membre d'une famille";
const SEX = "sexe";
const ROLE = 'role';
const FIRSTNAME = 'prénom';
const LASTNAME = 'nom de famille';


########## messages
const WARNING_UNKNOWN_MODEL_VALUE = 'Warning - unknown model value';
const NO_ROUTE = 'No route for';


##### Lesson
const QNDB_API = "http://www.quebecnatation.com/QNDB/api";
const QNDB_API_LESSON_PATH = "http://www.quebecnatation.com/QNDB/api/lesson.php";
const SESSION_ADDED = "session ajoutee:";
const SESSION_UPDATED = "session mise-a-jour:";
const ADD_JOIN_FAMILY_MEMBER_LESSON = "ajouter un cours suivi";
const JOIN_FAMILY_MEMBER_LESSON = "cours suivi";