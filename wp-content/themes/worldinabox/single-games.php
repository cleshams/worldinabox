<?php
get_template_part('platform/partials', 'header');
the_post();

$title = get_the_title();

$units = wp_get_post_terms($id, 'unit');
$proceed = false;
foreach($units as $unit)
{
    if(in_array($unit->slug, array_keys($_SESSION['memberships'])) || in_array('world-in-a-box-full', array_keys($_SESSION['memberships']))) { $proceed = true;} 
}

if(!$proceed) :
    $requiredMembership = get_page_by_path($units[0]->slug, OBJECT, 'wc_membership_plan');
    $productIds = get_post_meta($requiredMembership->ID, '_product_ids')[0];
    $url = get_the_permalink($productIds[0]);
    $unitNumber = get_field('unit_number','unit_'.$units[0]->ID); ?>
    <main>
        <section class="notice notice-no-membership container container--inner">
            <h3 class="text__title">Lesson not available</h3>
            <p>You do not have access to this lesson with your existing membership. You may purchase Unit <?php echo $unitNumber;?> to get access to this lesson and the rest of the unit content, or go back to the dashboard.</p>
            <div class="flex-links">
                <a href="<?php echo HOME_URI . '/dashboard'; ?>" class="text__sub-title">Back to Dashboard</a>
                <a href="<?php echo $url;?>" class="text__sub-title">Purchase Unit <?php echo $unitNumber .': ' . $units[0]->name;?></a>
            </div>
        </section>
    </main>

<?php
else :

$music = get_field('music_items');
$themeColour = get_field('theme_colour');
$intro = get_field('intro');
$instructions = get_field('instructions');
$tips = get_field('tips');
$image = get_field('image');

register_view($id);

?>
<main>

    <section class="container container--inner ">
        
        <div class="breadcrumbs">
            <?php
            echo '<a href="'.HOME_URI.'/dashboard">Dashboard</a>';
            echo ' > ';
            echo '<a href="'.HOME_URI.'/dashboard/active-games">Active Games</a>';
            echo ' > ';
            echo '<span>'.$title.'</span>'; ?>
        </div>

        <div class="lesson-content display--flex">

            <div class="lesson-main-content">

                <p class="text__med-title">Theme:</p>
                <h1><?php echo $title; ?></h1>
                <?php echo $intro; ?>

                <h2 class="text__big-title">Music</h2>
                <?php 
                renderMusicFields($music);
                ?>

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
endif;
get_template_part('platform/partials', 'footer');
?>