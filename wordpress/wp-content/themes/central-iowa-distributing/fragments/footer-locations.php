<?php
$locations_title = carbon_get_theme_option('crb_footer_locations_title');
$locations = carbon_get_theme_option('crb_footer_locations', 'complex');
?>

<?php if ($locations): ?>
	<section class="section-location">
		<?php if ($locations_title): ?>
			<h3><?php echo $locations_title; ?></h3>
		<?php endif ?>
		
		<?php
		foreach ($locations as $location) {
			echo wpautop($location['text']);
		}
		?>
	</section><!-- /.section-location -->
<?php endif ?>