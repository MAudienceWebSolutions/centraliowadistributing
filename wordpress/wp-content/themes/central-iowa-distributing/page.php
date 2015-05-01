<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="main">
				<div class="shell">
					<?php get_sidebar('subpage'); ?>
					
					<div class="content">
						<div <?php post_class('post'); ?>>
							
							<?php crb_the_title('<h2 class="pagetitle">', '</h2>'); ?>
							
							<div class="entry">
								<?php
								the_content(__('<p class="serif">' . __('Read the rest of this page &raquo;', 'crb') . '</p>'));
								
								wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'crb' ), 'after' => '</div>' ) );
								
								edit_post_link(__('Edit this entry.', 'crb'), '<p>', '</p>'); 
								?>
							</div>
						</div>	
						<?php get_template_part('fragments/footer-locations'); ?>
					</div><!-- /.content -->
				</div><!-- /.shell -->
			</div><!-- /.main -->
		<?php endwhile; ?>
	<?php endif; ?>
	
<?php get_footer(); ?>