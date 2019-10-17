<?php

/************ */
/* Lesson Variables 
/************ */

$unit = get_field('unit', $lessonId);
$objectives = get_field('objectives', $lessonId);
$title = get_the_title($lessonId);

$unit = wp_get_post_terms($lessonId, 'unit');
$unitID = $unit[0]->term_id;

/* Creative Task */
$creativeTaskFields = get_field('creative_task_group', $lessonId);

/* Main Activity */
$mainActivityFields = get_field('main_activity', $lessonId);

$introduction = get_field('introduction', $lessonId);
$reflection = get_field('reflection', $lessonId);

/* Warmup Variables */
$selectedWarmup = 443;
$warmupTitle = get_the_title($selectedWarmup);
$warmupResources = get_field('resources', $selectedWarmup);
$warmupInstructions = get_field('instructions_simple', $selectedWarmup);
$warmupDuration = get_field('duration', $selectedWarmup);
$warmDown = get_field('warm_down', $selectedWarmup);

/* Game Variables */
$selectedGame = 451;
$gameTitle = get_the_title($selectedGame);
$gameInstructions = get_field('instructions_simple', $selectedGame);
$gameDuration = get_field('duration', $selectedGame);
$gameResources = get_field('resources', $selectedGame);

/* Routine Variables */
$followAlong = 485;
$followAlongTitle = get_the_title($followAlong);
$followAlongContent = get_field('instructions_simple', $followAlong);
$followAlongDuration = get_field('duration', $followAlong);
$followAlongResource = get_field('video', $followAlong);

if(isset($counter))
{
    $counter++;
}
else
{
    $counter = 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title><?= $title; ?></title>
	<link rel="stylesheet" href="assets/css/styles.css" type="text/css"/>
	<meta name="robots" content="noindex, nofollow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>

<body class="pdf pdf--lesson">

    <div class="frame frame--bottom"></div>

    <div class="title-block">
        <h1><span class="text__subtitle text__blue">Lesson Plan: </span><span class="text__title text__pink"><?=$title; ?></span></h1>
    </div>

	

	<div class="pdf-area">
		<h2><span class="text__subtitle text__blue">Theme: </span><span class="text__title text__pink"><?= $unit[0]->name; ?></span></h2>
	</div>


    
	<table class="objectives bg__yellow" cellpadding="6">
        <tr>
            <th>Learning Objectives:</th>
            <td>
                <ul>
                    <?php foreach($objectives as $objective)
                    {
                        echo '<li>'.$objective['objective'].'</li>';
                    }
                    ?>
                </ul>
            </td>
        </tr>
	</table>

    <h3>Lesson Plan Overview</h3>
	<table class="main-content bg__yellow">
        <tr class="bg__blue">
            <th>Length</th>
            <th>Activity</th>
            <th>Selection</th>
            <th>Overview</th>
            <th>Resources</th>
        </tr>
        <tr>
            <td>5 mins</td>
            <td>Introduction</td>
            <td><?php echo $title; ?></td>
            <td><?php echo $introduction; ?></td>
            <td></td>
        </tr>
        <tr class="bg__orange">
            <td><?php echo $warmupDuration; ?> mins</td>
            <td>Warm Up</td>
            <td><?php echo $warmupTitle; ?></td>
            <td>Guide the class through a gentle warm up to prepeare the body for action</td>
            <td><?php echo $warmupResources; ?></td>
        </tr>
        <tr>
            <td><?php echo $gameDuration; ?> mins</td>
            <td>Active Game</td>
            <td><?php echo $gameTitle; ?></td>
            <td><?php echo $gameInstructions; ?></td>
            <td><?php echo $gameResources; ?></td>
        </tr>
        <tr class="bg__orange">
            <td><?php echo $followAlongContent; ?> mins</td>
            <td>Follow Along</td>
            <td><?php echo $warmupTitle; ?></td>
            <td><?php echo $followAlongContent; ?></td>
            <td><?php echo $followAlongResource; ?></td>
        </tr>
        <tr>
            <td><?php echo $mainActivityFields['duration']; ?> mins</td>
            <td>Main Activity</td>
            <td><?php echo $mainActivityFields['activity_title']; ?></td>
            <td><?php echo $mainActivityFields['description']; ?></td>
            <td><?php echo $mainActivityFields['resources']; ?></td>
        </tr>
        <tr class="bg__orange">
            <td><?php echo $creativeTaskFields['duration']; ?> mins</td>
            <td>Creative Task</td>
            <td><?php echo $creativeTaskFields['title']; ?></td>
            <td><?php echo $creativeTaskFields['description']; ?></td>
            <td><?php echo $creativeTaskFields['resources']; ?></td>
        </tr>
        <tr>
            <td>5 mins</td>
            <td>Warm Down</td>
            <td><?php echo $warmupTitle; ?></td>
            <td><?php echo $warmDown; ?></td>
            <td><?php echo $warmupResources; ?></td>
        </tr>
        <tr class="bg__orange">
            <td>5 mins</td>
            <td>Reflection</td>
            <td><?php echo $title; ?></td>
            <td><?php echo $reflection; ?></td>
            <td></td>
        </tr>
    </table>

</body>
</html>
