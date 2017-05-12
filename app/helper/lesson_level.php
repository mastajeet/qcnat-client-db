<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 12/05/17
 * Time: 11:23 AM
 */
class LessonLevel
{

    private static $default_corridor_size = 2;
    private static $default_rank = 100;

    static function get_lession_level_list(){
        return LessonLevel::$ordered_level_list;
    }

    static function get_lession_level_list_ordered_for_cartons(){
        return LessonLevel::$ordered_by_corridor_level_list;
    }


    static function is_valid_lesson_level($lesson_level){
        return array_key_exists($lesson_level,LessonLevel::$level_list);
    }

    static function get_lession_level_corridor_size($lession_level){
        if(LessonLevel::is_valid_lesson_level($lession_level)){
            return LessonLevel::$level_list[$lession_level]['corridor_size'];
        }
        return LessonLevel::$default_corridor_size;
    }

    static function get_lession_level_rank($lession_level){
        if(LessonLevel::is_valid_lesson_level($lession_level)){
            return LessonLevel::$level_list[$lession_level]['rank'];
        }
        return LessonLevel::$default_rank;
    }


    private static $level_list = [

        'Etoile de mer' => ['rank'=>1,'corridor_size'=>2],
        'Canard' =>        ['rank'=>2,'corridor_size'=>2],
        'Tortue de mer' => ['rank'=>3,'corridor_size'=>2],
        'Loutre de Mer' => ['rank'=>4,'corridor_size'=>2],
        'Salamandre' =>     ['rank'=>5,'corridor_size'=>2],
        'Poisson Lune' =>   ['rank'=>6,'corridor_size'=>2],
        'Crocodile' =>      ['rank'=>7,'corridor_size'=>2],
        'Baleine' =>        ['rank'=>8,'corridor_size'=>2],

        'Junior 1' => ['rank'=>9,'corridor_size'=>2],
        'Junior 2' => ['rank'=>10,'corridor_size'=>2],
        'Junior 3' => ['rank'=>11,'corridor_size'=>2],
        'Junior 4' => ['rank'=>12,'corridor_size'=>2],
        'Junior 5' => ['rank'=>13,'corridor_size'=>2],
        'Junior 6' => ['rank'=>14,'corridor_size'=>1],
        'Junior 7' => ['rank'=>15,'corridor_size'=>1],
        'Junior 8' => ['rank'=>16,'corridor_size'=>1],
        'Junior 9' => ['rank'=>17,'corridor_size'=>1],
        'Junior 10' => ['rank'=>18,'corridor_size'=>1],

        'Condi Phys + Cor. S' => ['rank'=>19,'corridor_size'=>1],
        'Cours Prive1' => ['rank'=>20,'corridor_size'=>1],
        'Cours Prive2' => ['rank'=>21,'corridor_size'=>1],
        'Cours Prive3' => ['rank'=>22,'corridor_size'=>1],
        'Cours Prive4' => ['rank'=>23,'corridor_size'=>1],
        'Cours Prive5' => ['rank'=>24,'corridor_size'=>1],
        'Cours Semi-Prive' => ['rank'=>25,'corridor_size'=>1],
        'Cours Semi-prive2' => ['rank'=>26,'corridor_size'=>1],

        'Essentiel 1' => ['rank'=>27,'corridor_size'=>2],
        'Essentiel 2' => ['rank'=>28,'corridor_size'=>1],
        'Style de nage' => ['rank'=>29,'corridor_size'=>1],
        'Maitre-Nageurs' => ['rank'=>30,'corridor_size'=>1],
        'Maitre-Nageurs Junior' => ['rank'=>31,'corridor_size'=>1],

        'Pre/Post Natal' => ['rank'=>32,'corridor_size'=>1],
        'Aqua-Forme' => ['rank'=>33,'corridor_size'=>1],
        'Aqua-Jogging' => ['rank'=>34,'corridor_size'=>1],
        'Aquaforme arthritique' => ['rank'=>35,'corridor_size'=>1],
        'Bain Libre' => ['rank'=>36,'corridor_size'=>1],

    ];

    private static $ordered_by_corridor_level_list= [

        'Etoile de mer',
        'Canard'   ,
        'Tortue de mer',
        'Loutre de Mer',
        'Salamandre' ,
        'Poisson Lune' ,
        'Crocodile',
        'Baleine' ,
        'Junior 1',
        'Junior 2',
        'Junior 3',
        'Junior 4',
        'Junior 5',
        'Cours Prive1',
        'Cours Prive2',
        'Cours Prive3',
        'Cours Prive4',
        'Cours Prive5',
        'Cours Semi-Prive',
        'Cours Semi-prive2',
        'Essentiel 1',

        'Junior 6',
        'Junior 7',
        'Junior 8',
        'Junior 9',
        'Junior 10',
        'Condi Phys + Cor. S',
        'Essentiel 2',
        'Style de nage',
        'Maitre-Nageurs',
        'Maitre-Nageurs Junior',
        'Pre/Post Natal',
        'Aqua-Forme',
        'Aqua-Jogging',
        'Aquaforme arthritique',
        'Bain Libre',
    ];

    private static $ordered_level_list  = [

        'Etoile de mer',
        'Canard'   ,
        'Tortue de mer',
        'Loutre de Mer',
        'Salamandre' ,
        'Poisson Lune' ,
        'Crocodile',
        'Baleine' ,
        'Junior 1',
        'Junior 2',
        'Junior 3',
        'Junior 4',
        'Junior 5',
        'Junior 6',
        'Junior 7',
        'Junior 8',
        'Junior 9',
        'Junior 10',
        'Condi Phys + Cor. S',
        'Cours Prive1',
        'Cours Prive2',
        'Cours Prive3',
        'Cours Prive4',
        'Cours Prive5',
        'Cours Semi-Prive',
        'Cours Semi-prive2',
        'Essentiel 1',
        'Essentiel 2',
        'Style de nage',
        'Maitre-Nageurs',
        'Maitre-Nageurs Junior',
        'Pre/Post Natal',
        'Aqua-Forme',
        'Aqua-Jogging',
        'Aquaforme arthritique',
        'Bain Libre',
    ];


}