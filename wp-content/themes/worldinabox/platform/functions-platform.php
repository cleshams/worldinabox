<?php
function get_breadcrumbs($unit, $title)
{
    echo '<a href="'.HOME_URI.'/dashboard">Dashboard</a>';
    echo ' > ';
    echo '<a href="'.HOME_URI.'/dashboard/unit-'.$unit->slug.'">'.$unit->name.'</a>';
    echo ' > ';
    echo '<span>'.$title.'</span>';
}
