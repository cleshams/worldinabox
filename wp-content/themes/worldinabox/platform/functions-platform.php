<?php
function get_breadcrumbs($unit, $title)
{
    $homeUrl = HOME_URI;
    echo '<a href="'.HOME_URI.'/platform">Home</a>';
    echo ' > ';
    echo '<a href="'.$homeUrl.'/platform/'.$unit->slug.'">'.$unit->name.'</a>';
    echo ' > ';
    echo '<span>'.$title.'</span>';
}