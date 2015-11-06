<?php
$default_logo_url = get_template_directory_uri() . '/images/logo.png';
$header_logo = carbon_get_theme_option('crb_header_logo');
$logo_img_src = wp_get_attachment_image_src($header_logo, 'header-logo');
$logo_url = $logo_img_src ? $logo_img_src[0] : $default_logo_url;
$header_text = carbon_get_theme_option('crb_header_text');
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, height=device-height, maximum-scale=1" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="header">
		<div class="shell">
			<div class="header-inner">
				<a href="<?php echo home_url('/'); ?>" style="background-image: url(<?php echo $logo_url; ?>);" class="logo"><?php bloginfo('name'); ?></a>
				
				<?php if ($header_text): ?>
					<div class="callout">
						<?php echo wpautop(do_shortcode($header_text)); ?>
					</div><!-- /.callout -->
				<?php endif ?>
			</div><!-- /.header-inner -->

			<div class="bar">
				<nav class="nav">
					<a href="#" class="btn-menu"><span></span></a>

					<?php
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'fallback_cb' => false,
						'container' => '',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth' => 1,
					));
					?>
				</nav><!-- /.nav -->

				<div class="search">
					<i class="ico ico-search"></i>

					<?php get_search_form(); ?>
				</div><!-- /.search -->
			</div><!-- /.bar -->
		</div><!-- /.shell -->
	</header><!-- /.header -->
