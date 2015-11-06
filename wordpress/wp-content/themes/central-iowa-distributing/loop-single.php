<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		
		<div <?php post_class() ?>>
			<h2><?php the_title(); ?></h2>

			<?php get_template_part('fragments/post-meta'); ?>

			<div class="entry">
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'crb') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div><!-- /div.entry -->
		</div> <!-- /div.post -->
		
		<?php comments_template(); ?>
	<?php endwhile; ?>
<?php endif; ?>