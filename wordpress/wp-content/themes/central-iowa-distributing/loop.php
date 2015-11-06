<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	
		<div <?php post_class('post') ?>>
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __('Permanent Link to %s', 'crb'), get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>

			<?php get_template_part('fragments/post-meta'); ?>

			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
		</div>

	<?php endwhile; ?>

	<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'crb')); ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'crb')); ?></div>
		</div>
	<?php endif; ?>
	
<?php else : ?>
	<div id="post-0" class="post error404 not-found">
		<div class="entry">
			<?php  
			if ( is_category() ) { // If this is a category archive
				printf("<p>" . __("Sorry, but there aren't any posts in the %s category yet.", 'crb') . "</p>", single_cat_title('',false));
			} else if ( is_date() ) { // If this is a date archive
				echo("<p>" . __("Sorry, but there aren't any posts with this date.", 'crb') . "</p>");
			} else if ( is_author() ) { // If this is a category archive
				$userdata = get_user_by('id', get_queried_object_id());
				printf("<p>" . __("Sorry, but there aren't any posts by %s yet.", 'crb') . "</p>", $userdata->display_name);
			} else if ( is_search() ) {
				echo("<p>" . __('No posts found. Try a different search?', 'crb') . "</p>");
			} else {
				echo("<p>" . __('No posts found.', 'crb') . "</p>");
			}
			get_search_form(); 
			?>
		</div>
	</div>
<?php endif; ?>