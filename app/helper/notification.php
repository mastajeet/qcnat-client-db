<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 28/06/17
 * Time: 8:51 PM
 */

function add_notification($title, $content){
    $notification = new HTMLHelper();
    $notification->opentable();
        $notification->openrow();
        $notification->opencol();
            $notification->addtexte($title,"notification-title");
    $notification->br(1);
        $notification->closerow();
        $notification->closecol();

        $notification->openrow();
        $notification->opencol();
        if(is_array($content)){
            foreach($content as $index=>$line) {
                if(is_numeric($index)){
                    $notification->addoutput("<span class='notification-text'>".$line."</span>",0,0);
                    $notification->br(1);
                }else{
                    $notification->addoutput("<span class='notification-subtitle'>".ucfirst($index).": <span class='notification_text'>".$line."</span><br>",0,0);
                    $notification->br(1);

                }
            }
        }else{
            $notification->addoutput("<div class='notification-text'>".$content."</div><br>",0,0);
            $notification->br(1);
        }
        $notification->closerow();
        $notification->closecol();

        return $notification->send(1);
}