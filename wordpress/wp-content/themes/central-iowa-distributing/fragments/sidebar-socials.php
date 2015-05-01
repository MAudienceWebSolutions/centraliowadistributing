<?php
$socials_title = carbon_get_theme_option('crb_socials_title');
$socials_raw = crb_get_social_sites();
$socials = array();

if ($socials_raw) {
	foreach ($socials_raw as $id => $name) {
		$item_link = carbon_get_theme_option( 'crb_' . $id );

		if ($item_link) {
			$socials[] = array(
				'link' => $item_link,
				'id' => $id,
			);
		}
	}
}

if (!$socials) {
	return;
}

?>
<?php if ($socials_title): ?>
	<div class="widget-head">
		<h3 class="widget-title"><?php echo $socials_title; ?></h3><!-- /.widget-title -->
	</div><!-- /.widget-head -->
<?php endif ?>

<div class="widget-body">
	<div class="socials">
		<ul>
			<?php foreach ($socials as $social_item): ?>
				<li>
					<a target="_blank" href="<?php echo esc_url($social_item['link']); ?>" class="link-<?php echo $social_item['id']; ?>"><i class="icon-<?php echo $social_item['id']; ?>-circled"></i></a>
				</li>
			<?php endforeach ?>
		</ul>
	</div><!-- /.socials -->
</div><!-- /.widget-body -->