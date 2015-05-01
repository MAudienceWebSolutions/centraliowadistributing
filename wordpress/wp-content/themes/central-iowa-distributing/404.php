<?php get_header(); ?>

<div class="main">
	<div class="shell">
		<?php get_sidebar('subpage'); ?>

		<div class="content">
			<div <?php post_class('post'); ?>>
				
				<?php crb_the_title('<h2 class="pagetitle">', '</h2>'); ?>
				
				<div class="entry">
					<?php
					printf(__('<p>Please check the URL for proper spelling and capitalization.<br />If you\'re having trouble locating a destination, try visiting the <a href="%1$s">home page</a>.</p>', 'crb'), home_url('/'));
					?>
				</div>
			</div>	
			<?php get_template_part('fragments/footer-locations'); ?>
		</div><!-- /.content -->
	</div><!-- /.shell -->
</div><!-- /.main -->
	
<?php get_footer(); ?>