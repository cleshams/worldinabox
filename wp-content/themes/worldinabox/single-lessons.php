<?php
get_header();
the_post();

$unit = get_field('unit');
$duration = get_field('duration');
$objectives = get_field('objectives');
$title = get_the_title();

$into = get_field('objectives');
$new_moves = get_field('new_moves');
$creative_task = get_field('creative_task');
$resources = get_field('resources');
$additional_content = get_field('additonal_content');
?>

<?php
get_breadcrumbs($unit[0], $title);
?>

<?php 
get_footer();
?>