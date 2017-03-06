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


#### FORM default VALUES #######

const ACTION_ADD = 'ajouter';

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
const DISPLAY_FAMILIES = "familles";
const INITIAL_ID = 1000;
const DEFAULT_REGIONAL_CODE = 514;

#### FamilyMember ####
const ADD_MODIFY_FAMILY_MEMBER = "Ajouter / Modifier un membre d'une famille";
const SEX = "sexe";
const ROLE = 'role';
const FIRSTNAME = 'prénom';
const LASTNAME = 'nom de famille';
const DATE_FORMAT = "d F Y";


########## messages
const WARNING_UNKNOWN_MODEL_VALUE = 'Warning - unknown model value';
const EXCEPTION_TOO_MANY_FAMILIES_FOUND = "Plusieurs familles ont ete trouvees pour ce numero de telephone";
const EXCEPTION_CANNOT_SPLIT_LESSON_BY_TIME = "La fonctionnalite de specifier une heure pour les lecon n'est pas implementee";
const NO_ROUTE = 'No route for';


##### Cahier

const DISPLAY_CAHIER = "cahiers";
const AVAILABLE_CAHIERS = "cahiers disponibles";

##### Lesson
const QNDB_API = "http://www.quebecnatation.com/QNDB/api";
const QNDB_API_LESSON_PATH = "http://www.quebecnatation.com/QNDB/api/lesson.php";
const SESSION_ADDED = "session ajoutee:";
const SESSION_UPDATED = "session mise-a-jour:";
const DISPLAY_LESSONS = "lecons";
const LESSON = "lecon";
const SELECT_LESSON = "Selectionnez une lecon";
const PREFIX = "Prefixe";
const ADD_JOIN_FAMILY_MEMBER_LESSON = "ajouter un cours suivi";
const JOIN_FAMILY_MEMBER_LESSON = "cours suivi";
const LESSON_POOL = "piscine";
const LESSON_LEVEL = "niveau";
const LESSON_SESSION = "session";
const LESSON_ADD_FAMILY_MEMBER= "ajouter des élèves à un cours";
const LESSON_DAY= "jour";
const LESSON_TIME= "heure";
const LESSON_INSTRUCTOR = "instructeur";


###### Form Actions

const SELECT = "selectionnner";