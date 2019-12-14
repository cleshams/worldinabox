<?php
get_template_part('platform/partials', 'header');
the_post();

$id = get_the_ID();

$unit = get_field('unit');
$duration = get_field('duration');
$objectives = get_field('objectives');
$title = get_the_title();
$lessonNum = get_field('lesson_number');

$intro = get_field('overview');
$new_moves = get_field('new_moves');
$video = get_field('video');
$placeholder = get_field(('video_placeholder'));
$creative_task = get_field('creative_task');
$resources = get_field('resources');
$additional_content = get_field('additional_content');
$popout = get_field('popout_message');

$unit = wp_get_post_terms($id, 'unit');
$unitID = $unit[0]->term_id;
$unitNumber = get_field('unit_number','unit_'.$unitID);
$logo = get_field('unit_logo', 'unit_'.$unitID);
$unitColour = get_field('colour', 'unit_'.$unitID);

register_view($id);
?>
<main>

<?php if($video)
{
?>
    <div class="modal vimeo-modal">
        <div class="iframe-container-container">
            <div class="iframe-container">
            </div>
            <button class="close-modal">X</button>
        </div>
    </div>
<?php
}
?>

    <section class="container container--inner ">
        
        <div class="breadcrumbs">
            <?php get_breadcrumbs($unit[0], $title); ?>
        </div>

        <div class="lesson-content display--flex">

            <div class="lesson-main-content">

                <p class="text__med-title">Lesson <?php echo $lessonNum; ?>:</p>
                <h1><?php echo $title; ?></h1>
                <?php echo $intro; ?>

                <div class="new-moves">
                    <h2 class="text__big-title">Learn <?= count($new_moves); ?> moves from the video</h2>
                    <div>
                        <ul>
                            <?php foreach($new_moves as $new_moves)
                            {
                                echo '<li>'.$new_moves['move'].'</li>';
                            }
                            ?>
                        </ul>
                        <?php
                        if($video)
                        {
                            echo '
                            <button class="trigger-video" title="Play '.$title.' video" data-src="'.$video.'">
                                <img src="'.$placeholder['url'].'" alt="trigger '.$title.' video"/>
                            </button>  ';
                        }
                        ?>
                    </div>
                </div>

                <h2 class="text__big-title">Creative Task</h2>
                <?php echo $creative_task; ?>

                <?php
                if(is_array($popout) && count($popout) > 0 && ($popout['title'] != '' || $popout['paragraph'] != '' ))
                {
                    echo '<div class="popout" style="background-color: '.$unitColour.';">';
                        echo '<h3 class="text__med-title">'.$popout['title'].'</h3>';
                        echo '<p >'.$popout['paragraph'].'</p>';
                    echo '</div>';
                }
                ?>

                <?php
                if(is_array($additional_content) && count($additional_content) > 0)
                {
                    foreach($additional_content as $content)
                    {
                        echo '<h2 class="text__big-title">'.$content['title'].'</h2>';
                        echo '<p>'.$content['content'].'</p>';
                    }
                }
                ?>

            </div>

            <div class="lesson-supplementary">
                <p class="text__sub-title">
                    Unit <?php echo $unitNumber; ?>
                </p>
                <?php echo '<img src="'.$logo['url'].'" alt="'.$title.' Logo" class="unit-logo" />'; ?>
                <dl>
                    <dt class="text__med-title">Recommended Duration</dt>
                    <dd><?php echo $duration; ?>mins</dd>
                
                
                    <dt class="text__med-title">Objectives</dt>
                    <?php
                    foreach($objectives as $objective)
                    {
                        echo '<dd>'.$objective['objective'].'</dd>';
                    }
                    ?>
                
                <?php
                if(is_array($resources) && count($resources) > 0) : ?>
                    <dt class="text__med-title">Resources</dt>
                    <?php
                    
                    foreach($resources as $resource)
                    {
                        $resourceType = $resource['resource_type'];
                        switch ($resourceType) {
                            case 'music':
                                $source = $resource['source'];
                                renderMusic($source, $resource);
                                break;
                            case 'video':
                                echo '
                                <dd><a href="'.$resource['url'].'" class="resource-link" target="_blank">
                                <span class="icon">';
                                include('assets/images/icons/youtube.php');
                                echo '</span>
                                <span>Video</span></a></dd>';
                                break;
                            case 'download':
                                $file = $resource['file'];
                                echo '
                                <dd><a href="'.$file['url'].'" class="resource-link" download>
                                    <span class="icon">';
                                    include('assets/images/icons/download.php');
                                    echo '</span>
                                    <span>'.$file['title'] . '</span>
                                </a></dd>';
                                break;
                            case 'web':
                                $link = $resource['url'];
                                echo '
                                <dd><a href="'.$link.'" target="_blank" class="resource-link">
                                    <span class="icon">';
                                        include('assets/images/icons/web.php');
                                    echo '</span>
                                    <span>' . $link . '</span>
                                </a></dd>';
                                break;
                            ;
                        }
                    }
                endif;
                    ?>
                    
                </dl>
            </div>
        </div>

    </section>

    <section class="pagination">
        <?php
        if($lessonNum > 1)
        {
            // prev lesson
        }
        if($lessonNum < 6)
        {
            // next lesson
        }
        ?>
    </section>

</main>
<?php 
get_template_part('platform/partials', 'footer');
?>