<?php
/**
*   Template name: Dashboard Search
**/

get_template_part('platform/partials', 'header');

$searchTerm = $_GET['search'];


$results1 = new WP_Query(array(
    'posts_per_page' => -1,
    's' => $searchTerm,
    'post_type' => array('lesson', 'followalongs', 'games', 'warmups'),
    'meta_query' => array(
        array(
        'key' => 'keywords',
        'value' => $searchTerm,
        'compare' => 'LIKE'
        ),
    )
));

$results2 = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => array('lesson', 'followalongs', 'games', 'warmups'),
    'tag' => strtolower($searchTerm),
));

$lessons = array();
$games = array();
$followalongs = array();
$warmups = array();


foreach($results1->posts as $post)
{
    if($post->post_type == 'lessons')
    {
        $lessons[] = $post;
    }
    if($post->post_type == 'games')
    {
        $games[] = $post;
    }
    if($post->post_type == 'followalongs')
    {
        $followalongs[] = $post;
    }
    if($post->post_type == 'warmups')
    {
        $warmups[] = $post;
    }
}
foreach($results2->posts as $post)
{
    if($post->post_type == 'lessons')
    {
        $lessons[] = $post;
    }
    if($post->post_type == 'games')
    {
        $games[] = $post;
    }
    if($post->post_type == 'followalongs')
    {
        $followalongs[] = $post;
    }
    if($post->post_type == 'warmups')
    {
        $warmups[] = $post;
    }
}
?>

<main>
    <header class="container container--inner ">
        <h1 class="text__center">Results for '<?php echo $searchTerm; ?>'</h1>
    </header>

    <section class="container container--inner ">
        <?php
        if(count($lessons) > 0)
        { ?>
            
            <h2 class="swoosh swoosh--orange">Lessons</h2>
        <?php
            foreach($lessons as $lesson)
            {
                $title = $lesson->post_title;
                $link = get_the_permalink($lesson);
                $unit = wp_get_post_terms($lesson->ID, 'unit');     $unitID = $unit[0]->term_id;
                $unitName = $unit[0]->name;     $unitNumber = get_field('unit_number','unit_'.$unitID);
                $unitLogo = $logo = get_field('unit_logo', 'unit_'.$unitID);
                
                $intro = get_field('overview', $lesson->ID);
                if($intro != '')
                {
                    $intro = '<p>' . wp_trim_words($intro, 30) . '</p>';
                }
                $task = get_field('creative_task_group')['title'];
                

                echo '
                <a href="'.$link.'" class="lesson-link">
                    <img class="unit-logo" src="' . $logo['url'] . '" alt=">Unit ' . $unitNumber .'"/>
                    <div class="content">
                        <h3 class="text__title">'.$title.'</h3>    
                        <div class="flex">
                            <span><span class="unit text__sub-title">Unit ' . $unitNumber .': </span>' . $unitName .' </span>
                            <span><span class="text__sub-title">Creative Task: </span>' . $task . '</span>
                        </div>
                        ' . $intro . '
                    </div>
                </a>';
            }
        }
        
        ?>

<?php
        if(count($games) > 0 || count($warmups) > 0 || count($followalongs) > 0)
        { ?>
            
            <h2 class="swoosh swoosh--green">Other Activities</h2>
            <section class="other-links">

        <?php
            foreach($games as $game)
            {
                $title = $game->post_title;
                $link = get_the_permalink($game);
                $type = 'Active Game';

                echo '
                <a href="'.$link.'">
                    <div class="text__title">'.$title.'</div>
                    <p><span class="text__sub-title">Activity: </span>'. $type .'</span></p>
                </a>';
            }

            foreach($warmups as $warmup)
            {
                $title = $warmup->post_title;
                $link = '../warm-ups/?warmup=' .$warmup->post_name;
                $type = 'Warm-Up';

                echo '
                <a href="'.$link.'">
                    <div class="text__title">'.$title.'</div>
                    <p><span class="text__sub-title">Activity: </span>'. $type .'</span></p>
                </a>';
            }

            foreach($followalongs as $followalong)
            {
                $title = $followalong->post_title;
                $link = '../follow-along-dance-routines/?warmup=' .$followalong->post_name;
                $type = 'Follow Along Dance Routine';

                echo '
                <a href="'.$link.'">
                    <div class="text__title">'.$title.'</div>
                    <p><span class="text__sub-title">Activity: </span>'. $type .'</span></p>
                </a>';
            }
        }
        
        ?>
        </section>
    </section>

</main>


<?php

get_template_part('platform/partials', 'footer'); ?>