<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-13
 * Time: 11:31 PM
 */
print("<div class=BigHead>".BD_CLIENTS."</div><br>");
print("<a class=link href=".get_route('display_families').">".ucfirst(DISPLAY_FAMILIES)."</a><br>");
print("<a class=link href=".get_route('display_lesson').">".ucfirst(DISPLAY_LESSONS)."</a><br>");
print("<a class=link  href=".get_route('display_cahier').">".ucfirst(INSCRIPTION)."</a><br>");
print("-----------<br>");
print("<a class=link  href=".get_route('add_lesson').">".ucfirst(ADD_LESSON)."</a><br>");
print("<a class=link  href=".get_route('search_lesson').">".ucfirst(SEARCH_LESSON)."</a><br>");

