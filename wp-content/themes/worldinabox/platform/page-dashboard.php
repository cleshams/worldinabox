<?php
/**
*   Template name: Dashboard
**/

get_template_part('platform/partials', 'header');

while ( have_posts() ) : the_post();
?>

<main>

    <section class="section__lesson-links">
        <div class="container container--inner">

            <h1 class="text__center">Lessons</h1>
            
            <ul class="lesson-links flex-third">
            <?php
            $units = get_terms('unit');
            foreach($units as $unit)
            {
                $title = $unit->name;
                $slug = $unit->slug;
                $color = hextorgb(get_field('colour', 'unit_'.$unit->term_id));
                $backgroundImage = get_field('background_image', 'unit_'.$unit->term_id);
                $number = get_field('unit_number', 'unit_' . $unit->term_id);

                $valid = (in_array($slug, array_keys($_SESSION['memberships'])) || in_array('world-in-a-box-full', array_keys($_SESSION['memberships']))) ? true : false;
                if($valid) :
                    echo '<li class="lesson-link card card__image-bg card__colour-overlay" style="background-image:url('.$backgroundImage['url'].');">';
                        echo '<div class="overlay" style=" background-color: rgb('.$color.');"></div>';
                        echo '<div class="inner">';
                            echo '<p class="text__sub-title">Unit '.$number.'</p>';
                            echo '<h2><a href="/dashboard/unit-'.$slug.'">'.$title.'</a></h2>';
                            echo '<span class="btn--bordered-white btn btn--small">Lessons </span>';
                        echo '</div>';
                    echo '</li>';
                else :
                    $requiredMembership = get_page_by_path($slug, OBJECT, 'wc_membership_plan');
                    $productIds = get_post_meta($requiredMembership->ID, '_product_ids')[0];
                    $url = get_the_permalink($productIds[0]);
                    echo '<li class="lesson-link card card__image-bg card__colour-overlay" style="background-image:url('.$backgroundImage['url'].');">';
                        echo '<div class="overlay" style=" background-color: rgb('.$color.');"></div>';
                        echo '<div class="inner">';
                            echo '<p class="text__sub-title">Unit '.$number.'</p>';
                            echo '<h2><a href="'.$url.'" target="_blank">'.$title.'</a></h2>';
                            echo '<span class="btn--bordered-white btn btn--small">Purchase Unit '.$number.'</span>';
                        echo '</div>';
                    echo '</li>';
                    
                endif;
            }
            ?>
            </ul>

        </div>
    </section>

    <section class="section__activites-links">
        <div class="container container--inner">
            <h2 class="text__center">Activities</h2>
            <ul class="flex-third">
                <li><a href="/dashboard/warm-ups" class="btn btn--medium bg__purple">Warm-Ups</a></li>
                <li><a href="/dashboard/active-games" class="btn btn--medium">Active Games</a></li>
                <li><a href="/dashboard/follow-along-dance-routines/" class="btn btn--medium bg__blue">Follow Along Dance Routines</a></li>
            </ul>
            <h3 class="text__center">Need help finding something?</h3>
            <button class="btn search-tool-trigger text__center">Try our activity finder</button>
        </div>
    </section>

    <section class="cms bg__grey-light bg--grey-light-brush">
        <div class="container container--inner">
            <?php
                the_content();
            ?>
        </div>
    </section>

    <section class="section__additional-links">
        <div class="container container--inner">
            <ul class="flex-third">
                <li><a href="/dashboard/glossary" class="text__med-title">Glossary</a></li>
                <li><a href="/dashboard/active-minutes" class="text__med-title">Active Minutes</a></li>
                <li><a href="/dashboard/help-support" class="text__med-title">Help & Support</a></li>
            </ul>
        </div>
    </section>
    
</main>

<?php
get_template_part('platform/partials', 'footer');
?>

<?php
endwhile;
?>