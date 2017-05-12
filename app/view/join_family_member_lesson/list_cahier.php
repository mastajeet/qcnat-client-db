<?php
/**
 * Created by PhpStorm.
 * User: mastajeet
 * Date: 17-03-05
 * Time: 19:53
 */

$output = new HTMLHelper();
$output->opentable('600');

$output->openrow();
$output->opencol(600, 4);
$output->addtexte(ucfirst(AVAILABLE_CAHIERS));
$output->closecol();
$output->closerow();

foreach ($cahier as $session => $pools) {
    $output->openrow();

    if (is_array($pools)) {
        $output->opencol(10, 1);
        $output->addpic("ressource/icon/folder_open.png");
        $output->closecol();
    } else {
        $output->opencol(10, 1);
        $output->addpic("ressource/icon/folder_close.png", '', get_route('display_cahier') . "&filter[session]=" . $session);
        $output->closecol();
    }

    $output->opencol(575, 3);
    $output->addtexte($session);
    $output->closecol();
    $output->closerow();


    if (is_array($pools)) {
        foreach ($pools as $pool => $days) {
            $output->openrow();
            $output->opencol(25, 1);
                $output->addtexte(" ");
            $output->closecol();

            $output->opencol(75, 1);
                $output->addpic("ressource/icon/print_ressource.png",'',get_route('obtain_cahier')."&filter[session]=" . $session."&filter[pool]=".$pool);
                $output->addpic("ressource/icon/edit_ressource.png",'',get_route('obtain_carton')."&filter[session]=" . $session."&filter[pool]=".$pool);
            $output->closecol();

            $output->opencol(925, 1);
            $output->addtexte($pool);
            $output->closecol();
            $output->closerow();


        }
    }


}


echo($output->send(1));