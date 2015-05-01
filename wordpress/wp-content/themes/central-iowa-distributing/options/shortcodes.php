<?php

/**
 * Returns current year
 *
 * @uses [year]
 */
add_shortcode('year', 'crb_shortcode_year');
function crb_shortcode_year() {
	return date('Y');
}

add_shortcode('crb_button', 'crb_add_button');
function crb_add_button($atts, $content) {
	$atts = shortcode_atts(
		array(
			'link' => '#',
			'text' => '',
			'target' => ''
		),
		$atts, 'crb_button'
	);

	if (!$content) {
		return '';	
	}

	ob_start();
	?>
	<a href="<?php echo esc_url($atts['link']); ?>" <?php echo $atts['target'] ? 'target="_' . $atts['target'] . '"' : ''; ?> class="btn-shop"><?php echo $content; ?></a>
	<?php
	$html = ob_get_clean();

	return $html;
}
