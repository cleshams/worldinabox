<?php
get_template_part('platform/partials', 'header');
?>

<main>
<?php

$unit = get_queried_object();

$logo = get_field('unit_logo', 'unit_'.$unit->term_id);
$number = get_field('unit_number', 'unit_' . $unit->term_id);
$title = $unit->name;
$description = $unit->description;

echo '
    <section class="unit-information container container--inner ">
        
        
        <div class="display--flex unit-info display--two-gapped">
            <div>
                <img src="'.$logo['url'].'" alt="'.$title.' Logo" />
            </div>
            <div>
            <p class="text__med-title">Unit '.$number.'</p>
                <h1>'.$title.'</h1>
                <p class="text__larger">'.$description.'</p>
            </div>
        </div>
    </section>';

    if(have_posts()) : 
    echo '
    <section class="container container--inner">
    <h2 class="text__center">Lessons</h2>
        <ul class="unit-lesson-links flex-third">';

        $index = 1;
        while(have_posts()) : the_post();

            echo '
            <li class="lesson--shape">
                <a href="'.get_the_permalink().'">
                <span class="text__sub-title">Lesson '.$index.'</span>
                <h3>'.get_the_title().'</h3>
                </a>
            </li>';
        $index++;
        endwhile;
    echo '</ul>
    </section>';
    endif;
?>
    <section class="section__activites-links">
        <div class="container container--inner">
            <h2 class="text__center">Activities</h2>
            <ul class="flex-third">
                <li><a href="/dashboard/warm-ups" class="btn btn--medium bg__purple">Warm-Ups</a></li>
                <li><a href="/dashboard/games" class="btn btn--medium">Active Games</a></li>
                <li><a href="/dashboard/follow-along-dance-routines/" class="btn btn--medium bg__blue">Follow Along Dance Routines</a></li>
            </ul>
        </div>
    </section>

</main>
<?php
get_template_part('platform/partials', 'footer');
?>
