<?php
define('CRB_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);

# Enqueue JS and CSS assets on the front-end
add_action('wp_enqueue_scripts', 'crb_wp_enqueue_scripts');
function crb_wp_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue jQuery
	wp_enqueue_script('jquery');

	# Enqueue Custom JS files
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	crb_enqueue_script('jquery.bxslider', $template_dir . '/js/jquery.bxslider.min.js');
	crb_enqueue_script('jquery.fs.selecter', $template_dir . '/js/jquery.fs.selecter.min.js');
	crb_enqueue_script('theme-functions', $template_dir . '/js/functions.js', array('jquery'));

	# Enqueue Custom CSS files
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	crb_enqueue_style('jquery.fs.selecter', $template_dir . '/css/jquery.fs.selecter.css');
	crb_enqueue_style('fontello', $template_dir . '/css/fontello.css');
	crb_enqueue_style('theme-styles', $template_dir . '/style.css');

	# Enqueue Comments JS file
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
}

# Enqueue JS and CSS assets on admin pages
add_action('admin_enqueue_scripts', 'crb_admin_enqueue_scripts');
function crb_admin_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue Scripts
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	# crb_enqueue_script('theme-admin-functions', $template_dir . '/js/admin-functions.js', array('jquery'));
	
	# Enqueue Styles
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	# crb_enqueue_style('theme-admin-styles', $template_dir . '/css/admin-style.css');
}

# Attach Custom Post Types and Custom Taxonomies
add_action('init', 'crb_attach_post_types_and_taxonomies', 0);
function crb_attach_post_types_and_taxonomies() {
	# Attach Custom Post Types
	include_once(CRB_THEME_DIR . 'options/post-types.php');

	# Attach Custom Taxonomies
	include_once(CRB_THEME_DIR . 'options/taxonomies.php');
}

add_action('after_setup_theme', 'crb_setup_theme');

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if (!function_exists('crb_setup_theme')) {
	function crb_setup_theme() {
		# Make this theme available for translation.
		load_theme_textdomain( 'crb', get_template_directory() . '/languages' );

		# Common libraries
		include_once(CRB_THEME_DIR . 'lib/common.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-fields/carbon-fields.php');
		include_once(CRB_THEME_DIR . 'lib/admin-column-manager/carbon-admin-columns-manager.php');

		# Additional libraries and includes
		include_once(CRB_THEME_DIR . 'includes/comments.php');
		include_once(CRB_THEME_DIR . 'includes/title.php');
		include_once(CRB_THEME_DIR . 'includes/gravity-forms.php');
		
		# Theme supports
		add_theme_support('automatic-feed-links');
		add_theme_support('menus');
		add_theme_support('post-thumbnails');

		# Image sizes
		add_image_size('header-logo', 239, 136, true);
		add_image_size('homepage-slider-image', 711, 287, true);
		add_image_size('homepage-service-image', 116, 116, true);
		add_image_size('homepage-product-image', 219, 216, true);

		# Manually select Post Formats to be supported - http://codex.wordpress.org/Post_Formats
		// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		# Register Theme Menu Locations
		register_nav_menus(array(
			'main-menu'=>__('Main Menu', 'crb'),
		));
		
		
		# Attach custom widgets
		include_once(CRB_THEME_DIR . 'options/widgets.php');

		# Attach custom shortcodes
		include_once(CRB_THEME_DIR . 'options/shortcodes.php');

		# Attach custom columns
		include_once(CRB_THEME_DIR . 'options/admin-columns.php');
		
		# Add Actions
		add_action('widgets_init', 'crb_widgets_init');

		add_action('carbon_register_fields', 'crb_attach_theme_options');
		add_action('carbon_after_register_fields', 'crb_attach_theme_help');

		# Add Filters
	}
}

# Register Sidebars
# Note: In a child theme with custom crb_setup_theme() this function is not hooked to widgets_init
function crb_widgets_init() {
	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Default Sidebar',
		'id'   => 'default-sidebar',
	));
	register_sidebar($sidebar_options);

	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Subpage Sidebar',
		'id'   => 'subpage-sidebar',
	));
	register_sidebar($sidebar_options);
}

# Sidebar Options
function crb_get_default_sidebar_options() {
	return array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);
}
function crb_attach_theme_options() {
	# Attach fields
	include_once(CRB_THEME_DIR . 'options/theme-options.php');
	include_once(CRB_THEME_DIR . 'options/custom-fields.php');
}

function crb_attach_theme_help() {
	# Theme Help needs to be after options/theme-options.php
	include_once(CRB_THEME_DIR . 'lib/theme-help/theme-readme.php');
}

add_filter('excerpt_more', 'crb_new_custom_excerpt_more');
function crb_new_custom_excerpt_more( $more ) {
	return '';
}

add_filter('excerpt_length', 'crb_custom_excerpt_length', 999);
function crb_custom_excerpt_length($length) {
	return 15;
}

function crb_get_social_sites() {
	return array(
		'facebook' => 'Facebook',
		'twitter' => 'Twitter',
	);
}

add_action('woocommerce_before_main_content', 'crb_woocommerce_content_open_wrappers', 9);
function crb_woocommerce_content_open_wrappers() {
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	?>
	<div class="main">
		<div class="shell">

	<?php
	get_sidebar('subpage');
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	?>
	<div class="content">
	<?php
	add_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}

add_action('woocommerce_after_shop_loop', 'crb_woocommerce_content_close_wrappers', 99);
function crb_woocommerce_content_close_wrappers() {
	get_template_part('fragments/footer-locations');
	?>		
			</div><!-- /.content -->
		</div><!-- /.shell -->
	</div><!-- /.main -->
	<?php
}

add_action('woocommerce_before_shop_loop', 'crb_woocommerce_add_product_search_form', 29);
function crb_woocommerce_add_product_search_form() {
	?>
	<div class="search-product">
	<?php
		get_product_search_form();
}

add_action('woocommerce_before_shop_loop', 'crb_woocommerce_add_product_search_form_close_wrapper', 31);
function crb_woocommerce_add_product_search_form_close_wrapper() {
	?>
	</div><!-- /.search-product -->
	<?php
}

add_action('woocommerce_before_shop_loop', 'crb_woocommerce_shop_products_wrappers', 99);
function crb_woocommerce_shop_products_wrappers() {
	?>
	<section class="section-products">
	<?php
}

add_action('woocommerce_after_shop_loop', 'crb_woocommerce_shop_products_close_wrappers', 5);
function crb_woocommerce_shop_products_close_wrappers() {
	?>
	</section><!-- /.section-products -->
	<?php
}

add_action('woocommerce_after_shop_loop_item', 'crb_woocommerce_add_read_more_to_product', 9);
function crb_woocommerce_add_read_more_to_product() {
	if (!is_single()) {
	?>
		<a href="<?php the_permalink(); ?>" class="link-more">Details &gt;&gt;</a>
	<?php
	}
}

add_action('woocommerce_after_shop_loop_item_title', 'crb_woocommerce_add_price_label_before_amount', 9);
function crb_woocommerce_add_price_label_before_amount() {
	$is_wc_plugin_active = true;
	if (!class_exists('WC_Product')) {
		echo '<h3>Please activate the "WooCommerce" plugin</h3>';
		$is_wc_plugin_active = false;
	}

	if ($is_wc_plugin_active) {
		$product = new WC_Product(get_the_ID());
	?>
		<div class="product-price">
			<span>Price:</span>
			<?php echo $product->get_price_html(); ?>
		</div>
	<?php
	}
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
}

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action('woocommerce_after_shop_loop', 'crb_woocommerce_custom_pagination', 9);
function crb_woocommerce_custom_pagination() {
	global $wp_query;
	?>
	<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		<div class="paging">
			<div class="paging-prev"><?php next_posts_link(__('Previous', 'crb')); ?></div><!-- /.paging-prev -->
		    	
			<span class="paging-separator">/</span>
			
			<div class="paging-next"><?php previous_posts_link(__('Next', 'crb')); ?></div><!-- /.paging-next -->
		</div><!-- /.paging -->
	<?php endif; ?>
	<?php
}

add_action('woocommerce_after_main_content', 'crb_woocommerce_add_footer_fragment_to_single_product_page', 99);
function crb_woocommerce_add_footer_fragment_to_single_product_page() {
	if (is_single()) {
		get_template_part('fragments/footer-locations');
	}
}

// filter - 6 products per page
add_filter( 'loop_shop_per_page', create_function('$cols', 'return 6;'), 20);