<?php
/**
*   Template name: Lesson Plans
**/

get_template_part('platform/partials', 'header');

$lessonId = (isset($_SESSION['lesson'])) ? $_SESSION['lesson'] : null;
$gameId = (isset($_SESSION['game'])) ? $_SESSION['game'] : null;
$warmupId = (isset($_SESSION['warmup'])) ? $_SESSION['warmup'] : null;
$routineId = (isset($_SESSION['routine'])) ? $_SESSION['routine'] : null;

$unit1Lessons = get_posts(array('post_type' => 'lessons', 'tax_query' => array(array(
    'taxonomy' => 'unit',
    'field' => 'slug',
    'terms' => 'dancing-around-the-world'
))));
$unit2Lessons = get_posts(array('post_type' => 'lessons', 'tax_query' => array(array(
    'taxonomy' => 'unit',
    'field' => 'slug',
    'terms' => 'journey-down-the-amazon'
))));
$unit3Lessons = get_posts(array('post_type' => 'lessons', 'tax_query' => array(array(
    'taxonomy' => 'unit',
    'field' => 'slug',
    'terms' => 'naach-india'
))));

$warmUps = get_posts(array('post_type' => 'warmups'));

$games = get_posts(array('post_type' => 'games'));

$routines = get_posts(array('post_type' => 'followalongs'));

while ( have_posts() ) : the_post();
?>

<main>

<section class="">
    <div class="container container--inner">
        <h1 class="text__center">Lesson Plans</h1>
    </div>
</section>

<section class="cms bg__grey-light bg--grey-light-brush">
    <div class="container container--inner">
        <?php
            the_content();
        ?>
    </div>
</section>        

<section>
    <div class="container container--inner">
        <h2 class="text__center">Select Content</h2>
        <form action="<?php echo HOME_URI; ?>/wp-content/pdf/pdf.php" method="post" class="pdf-plan-form display--flex display--flex-wrap">
            <div class="input-container">
                <select required name="pdf-lesson" id="pdf-lesson">
                    <?php
                    if($lessonId === null)
                    {
                        echo '<option selected disabled value="">Select a lesson</option>';
                    }
                    echo '<option disabled>Unit 1 Lessons</option>';
                    foreach($unit1Lessons as $lesson)
                    {
                        $id = $lesson->ID;
                        $selected = ($lessonId == $id) ? ' selected' : '';
                        echo '<option value="' . $id. '"' . $selected . '>' . $lesson->post_title . '</option>';
                    }
                    echo '<option disabled>Unit 2 Lessons</option>';
                    foreach($unit2Lessons as $lesson)
                    {
                        $id = $lesson->ID;
                        $selected = ($lessonId == $id) ? ' selected' : '';
                        echo '<option value="' . $id. '"' . $selected . '>' . $lesson->post_title . '</option>';
                    }
                    echo '<option disabled>Unit 3 Lessons</option>';
                    foreach($unit3Lessons as $lesson)
                    {
                        $id = $lesson->ID;
                        $selected = ($lessonId == $id) ? ' selected' : '';
                        echo '<option value="' . $id. '"' . $selected . '>' . $lesson->post_title . '</option>';
                    }
                    ?>
                </select>
                <label for="pdf-lesson">1. Lesson</label>
            </div>
            <div class="input-container">
                <select required name="pdf-warmup">
                    <?php
                     if($warmupId === null)
                     {
                         echo '<option selected disabled value="">Select a warm-up</option>';
                     }
                    foreach($warmUps as $warmup)
                    {
                        $id = $warmup->ID;
                        $selected = ($warmupId == $id) ? ' selected' : '';
                        echo '<option value="' . $id. '"' . $selected . '>' . $warmup->post_title . '</option>';
                    }
                    ?>
                </select>
                <label for="pdf-warmup">2. Warm Up</label>
            </div>

            <div class="input-container">
                <select required name="pdf-game">
                    <?php
                    if($gameId === null)
                    {
                        echo '<option selected disabled value="">Select a game</option>';
                    }
                    foreach($games as $game)
                    {
                        $id = $game->ID;
                        $selected = ($gameId == $id) ? ' selected' : '';
                        echo '<option value="' . $id. '"' . $selected . '>' . $game->post_title . '</option>';
                    }
                    ?>
                </select>
                <label for="pdf-game">3. Active Games</label>
            </div>

            <div class="input-container">
                <select required name="pdf-routine">
                    <?php
                    if($routineId === null)
                    {
                        echo '<option selected disabled value="">Select a routine</option>';
                    }
                    foreach($routines as $routine)
                    {
                        $id = $routine->ID;
                        $selected = ($routineId == $id) ? ' selected' : '';
                        echo '<option value="' . $id. '"' . $selected . '>' . $routine->post_title . '</option>';
                    }
                    ?>
                </select>
                <label for="pdf-routine">4. Follow Along Routine</label>
            </div>

            <div class="input-container">
                <input type="text" id="pdf-title" required name="pdf-title" placeholder="&nbsp;"/>
                <label for="pdf-title">5. Lesson Title</label>
            </div>
            <div class="input-container">
                <textarea id="pdf-objectives" required name="pdf-objectives" placeholder="&nbsp;" rows="5"></textarea>
                <label for="pdf-title">6. Lesson Objectives</label>
            </div>

            <div class="btn-container">
                <button class="btn text__center">Download PDF</button>
            </div>

        </form>
    </div>
</section>
    
    <?php
endwhile;

get_template_part('platform/partials', 'footer'); ?>