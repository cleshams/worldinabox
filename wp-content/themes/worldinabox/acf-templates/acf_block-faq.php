<?php
/**
 * Block Name: FAQ
 *
 * This is the template that displays the frequently asked questions block.
 */



// create id attribute for specific styling
$id = 'faq-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
if(have_rows('questions')) : echo '<div class="faq">';
    while(have_rows('questions')) : the_row();
    ?>
        <button class="accordion-toggle"><p class="faq-question text--semibold">
            <?php echo get_sub_field('question'); ?>      
            </p>
        </button>
        <p class="faq-answer">
            <?php echo get_sub_field('answer'); ?>
        </p>

    <?php
    endwhile;
    echo '</div>';
endif;
?>
