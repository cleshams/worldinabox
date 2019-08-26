<?php
get_template_part('platform/partials', 'header');
the_post();

$title = get_the_title();
$music = get_field('music');
$musicType = $music['link_type'];
$themeColour = get_field('theme_colour');
$intro = get_field('intro');
$instructions = get_field('instructions');
$tips = get_field('tips');
$image = get_field('image');

?>
<main>

    <section class="container container--inner ">
        
        <div class="breadcrumbs">
            <?php
            echo '<a href="'.HOME_URI.'/dashboard">Dashboard</a>';
            echo ' > ';
            echo '<a href="'.HOME_URI.'/dashboard/games">Active Games</a>';
            echo ' > ';
            echo '<span>'.$title.'</span>'; ?>
        </div>

        <div class="lesson-content display--flex">

            <div class="lesson-main-content">

                <p class="text__med-title">Theme:</p>
                <h1><?php echo $title; ?></h1>
                <?php echo $intro; ?>

                <h2 class="text__big-title">Music</h2>
                <a href="" class="resource-link">
                    <span class="icon"><?php include('assets/images/icons/' . $musicType . '.php'); ?></span>
                    <span><?php echo $music['title']; ?></span>
                </a>

                <div class="new-moves">
                    <h2 class="text__big-title">The Game</h2>
                    <div>
                        <ul>
                            <?php foreach($instructions as $instructions)
                            {
                                echo '<li>'.$instructions['instruction'].'</li>';
                            }
                            ?>
                        </ul>
                        
                    </div>
                </div>


                <?php
                if(!empty($tips))
                {
                    echo '<div class="popout" style="background-color: '.$themeColour.';">';
                        echo '<h3 class="text__med-title">Tips</h3>';
                        echo '<p>'.$tips.'</p>';
                    echo '</div>';
                }
                ?>



            </div>

            <div class="lesson-supplementary">
                <div class="image-container shape" style="background-image:url(<?php echo $image['url']; ?>)"></div>
            </div>
        </div>

    </section>

</main>
<?php 
get_template_part('platform/partials', 'footer');
?>