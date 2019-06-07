<?php get_header() ; ?>

    <?php if ( have_posts() ): ?>

    <?php while ( have_posts() ) : the_post(); ?>

		<section>
			<div class="container container--inner">
				<div class="content content__item">
					<div class="item-cards">
						<?php get_template_part('content/loop', 'post'); ?>
					</div>
				</div>
			</div>
		</section>


    <?php endwhile; endif; ?>

<?php get_footer(); ?>
