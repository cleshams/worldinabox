<?php
/**
*   Template name: Dashboard Search
**/

get_template_part('platform/partials', 'header');

$searchTerm = $_GET['search'];

$lessons = get_posts(array(
    'post_type' => 'lessons',
    'posts_per_page' => '10',
    's' => $searchTerm
));

$games = get_posts(array(
    'post_type' => 'games',
    'posts_per_page' => '10',
    's' => $searchTerm
));
$followalongs = get_posts(array(
    'post_type' => 'followalongs',
    'posts_per_page' => '10',
    's' => $searchTerm
));
$warmups = get_posts(array(
    'post_type' => 'warmups',
    'posts_per_page' => '10',
    's' => $searchTerm
));


?>

<main>
    <header class="container">
        <h1>Results for '<?php echo $searchTerm; ?>'</h1>
    </header>

    <section>
        <?php
        var_dump($lessons);
        var_dump($games);
        var_dump($followalongs);
        var_dump($warmups);
        ?>
    </section>

</main>


<?php

get_template_part('platform/partials', 'footer'); ?>