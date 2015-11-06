<?php get_header(); ?>

<div class="main">
	<div class="shell">
		<?php get_sidebar('subpage'); ?>
		
		<div class="content">
			<?php
			if (!is_single()) {
				crb_the_title('<h2 class="pagetitle">', '</h2>');
			}

			if ( is_single() ) {
				get_template_part( 'loop', 'single' );
			} else {
				get_template_part( 'loop' ); 
			}
			?>
			<?php get_template_part('fragments/footer-locations'); ?>
		</div><!-- /.content -->
	</div><!-- /.shell -->
</div><!-- /.main -->
	
<?php get_footer(); ?>