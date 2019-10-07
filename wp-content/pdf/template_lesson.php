<?php

/************ */
/* Lesson Variables 
/************ */

$unit = get_field('unit', $lessonId);
$duration = get_field('duration', $lessonId);
$objectives = get_field('objectives', $lessonId);
$title = get_the_title($lessonId);
// $lessonNum = get_field('lesson_number', $lessonId);

$creative_task = get_field('creative_task', $lessonId);
$resources = get_field('resources', $lessonId);

$unit = wp_get_post_terms($lessonId, 'unit');
$unitID = $unit[0]->term_id;


/* Warmup Variables */
$selectedWarmup = 443;
$warmupTitle = get_the_title($selectedWarmup);
$warmupResources = array();


/* Game Variables */
$selectedGame = 451;
$gameTitle = get_the_title($selectedGame);
$gameInstructionsArray = get_field('instructions', $selectedGame);
$gameInstructions = array();
foreach($gameInstructionsArray as $gameInstruction)
{
    $gameInstructions[] = $gameInstruction['instruction'];
}
$gameResources = array();

/* Routine Variables */
$followAlong = 485;
$followAlongTitle = get_the_title($followAlong);
$followAlongContent = get_field('contet', $followAlong);
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
            <td>Make sure the room is prepared and safe.<br>Introduce the session themes</td>
            <td></td>
        </tr>
        <tr class="bg__orange">
            <td>5 mins</td>
            <td>Warm Up</td>
            <td><?php echo $warmupTitle; ?></td>
            <td>Guide the class through a gentle warm up to prepeare the body for action</td>
            <td><?php echo implode('<br>', $warmupResources); ?></td>
        </tr>
        <tr>
            <td>10 mins</td>
            <td>Active Game</td>
            <td><?php echo $gameTitle; ?></td>
            <td><?php echo implode('<br>', $gameInstructions); ?></td>
            <td><?php echo implode('<br>', $gameResources); ?></td>
        </tr>
        <tr class="bg__orange">
            <td>10 mins</td>
            <td>Follow Along</td>
            <td><?php echo $warmupTitle; ?></td>
            <td><?php echo $followAlongContent; ?></td>
            <td><?php echo $followAlongResource; ?></td>
        </tr>
    </table>

</body>
</html>
