<?php

/************ */
/* Lesson Variables 
/************ */

$unit = get_field('unit', $lessonId);
$duration = get_field('duration', $lessonId);
$objectives = get_field('objectives', $lessonId);
$title = get_the_title($lessonId);
$lessonNum = get_field('lesson_number', $lessonId);

$new_moves = get_field('new_moves', $lessonId);
$video = get_field('video', $lessonId);
$placeholder = get_field(('video_placeholder'), $lessonId);
$creative_task = get_field('creative_task', $lessonId);
$resources = get_field('resources', $lessonId);
$additional_content = get_field('additional_content', $lessonId);
$popout = get_field('popout_message', $lessonId);

$unit = wp_get_post_terms($lessonId, 'unit');
$unitID = $unit[0]->term_id;
$unitNumber = get_field('unit_number','unit_'.$unitID);
$logo = get_field('unit_logo', 'unit_'.$unitID);
$unitColour = get_field('colour', 'unit_'.$unitID);

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title><?= $title; ?></title>
	<link rel="stylesheet" href="assets/css/styles.css" type="text/css"/>
	<meta name="robots" content="noindex, nofollow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>

<body class="pdf pdf--lesson" id="pdf--lesson">
	<div class="frame frame--bottom"></div>

	<div id="pdf-motty">
	    <img src="assets/images/motty.png" />
	</div>


	<div id="pdf-title">
		<p><span id="pdf-title-name"><?= $title; ?> Lesson Plan</span></p>
	</div>

	<div id="pdf-area">
		<p><span class="text__title">Unit:</span> <span><?= $unit[0]->name; ?></span></p>
	</div>


	<div id="pdf-objective">
        <p><strong>Objectives:</strong></p>
        <ul>
            <?php foreach($objectives as $objective)
            {
                echo '<li>'.$objective['objective'].'</li>';
            }
            ?>
        </ul>
	</div>


	<div class="section">

		<?php if($_resources || $_equipment): ?>
		<div id="pdf-equipment">

			<p class="title">you will need...</p>

			<?php if($_resources): ?>

				<div id="equipment__resources">

					<p><strong>resources:</strong></p>

					<p>
					There are downloadable resources available to accompany this lesson.
					</p>


				</div>

			<?php endif; ?>


			<?php if($_equipment): ?>

				<div id="equipment__equipment">

					<p><strong>equipment:</strong></p>

					<p>
					<?= $_equipment; ?>
					</p>

				</div>

			<?php endif; ?>

		</div>
		<?php endif; ?>


		<div id="pdf-image">
		<?php
			if($logo):

				$src = '..' . wp_make_link_relative($logo['url']);

			else:

				$src = $placeholders[array_rand($placeholders)];

			endif;
		?>

			<img src="<?= $src ?>" />

		</div>

	<div>



	<?php if($_focus): ?>

		<div id="pdf-focus" class="cl content">

			<span class="content__title">focus:</span>

			<?= $_focus; ?>

		</div>

	<?php endif; ?>



	<?php if($_instructions): ?>

		<div id="pdf-instructions" class="cl content">

			<span class="content__title">instructions:</span>

			<ol>
			<?php
				foreach($_instructions as $_item):
			?>
					<li><?= $_item['instruction']; ?></li>
			<?php
				endforeach;
			?>
			</ol>

		</div>

	<?php endif; ?>



	<?php
		if($_contentblock):
			foreach($_contentblock as $_block):
	?>

				<div id="" class="content">

					<span class="content__title"><?= $_block['title'] ?></span>

					<?php
						foreach($_block['block'] as $_b):
					?>
							<p><?= $_b['content']; ?></p>
					<?php
						endforeach;
					?>

				</div>

	<?php
			endforeach;

		endif;
	?>

</body>
</html>
