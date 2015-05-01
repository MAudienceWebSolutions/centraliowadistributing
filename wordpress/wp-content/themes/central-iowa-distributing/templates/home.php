<?php
/*
Template name: Home
*/

$homepage_slider = carbon_get_the_post_meta('crb_homepage_slider', 'complex');
$services_section_title = carbon_get_the_post_meta('crb_services_section_title');
$homepage_services = carbon_get_the_post_meta('crb_homepage_services', 'complex');
$fp_section_title = carbon_get_the_post_meta('crb_hp_products_section_title');
$featured_products = carbon_get_the_post_meta('crb_homepage_featured_products');
get_header();
?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		
		<div class="main">
			<div class="shell">
				<?php get_sidebar('subpage-sidebar'); ?>

				<div class="content">
					<?php if ($homepage_slider): ?>
						<div class="slider">
							<div class="slider-clip">
								<ul class="slides">
									<?php foreach ($homepage_slider as $slide): ?>
										<li class="slide">
											<?php if ($slide['image']): ?>
												<div class="slide-image">
													<?php echo wp_get_attachment_image($slide['image'], 'homepage-slider-image'); ?>
												</div><!-- /.slide-image -->
											<?php endif ?>
											
											<?php if ($slide['text']): ?>
												<div class="slide-content">
													<h2><?php echo $slide['text']; ?></h2>
												</div><!-- /.slide-content -->
											<?php endif ?>
										</li><!-- /.slide -->
									<?php endforeach ?>
								</ul><!-- /.slides -->
							</div><!-- /.slider-clip -->
						</div><!-- /.slider -->
					<?php endif ?>
					
					<?php if ($featured_products) : ?>
						<section class="section-featured">
							<?php if ($fp_section_title): ?>
								<h2 class="section-title"><?php echo $fp_section_title; ?></h2><!-- /.section-title -->
							<?php endif ?>
							

							<ul class="products">
								<?php foreach ($featured_products as $p_id): ?>
									<?php
									if (!class_exists('WC_Product')) {
										echo '<h3>Please activate the "WooCommerce" plugin</h3>';
										break;
									}

									$product = new WC_Product($p_id);
									$product_price = $product->get_price_html();
									$product_post = get_post($p_id);
									?>
									
									<li class="product">
										<a href="<?php echo $product->get_permalink(); ?>">
											<?php echo $product->get_image('homepage-product-image'); ?>

											<span class="product-title"><?php echo $product->get_title(); ?></span>
											
											<?php if ($product_price): ?>
												<span class="price-tag"><?php echo $product_price; ?></span>
											<?php endif ?>
										</a>

										<?php echo $product_post ? $product_post->post_excerpt : ''; ?>
										
										<a href="<?php echo $product->get_permalink(); ?>" class="link-more"><?php _e('More Details &gt;&gt;', 'crb'); ?></a>
									</li><!-- /.product -->
								<?php endforeach ?>
							</ul><!-- /.products -->
						</section><!-- /.section-featured -->
					<?php endif ?>
					
					<?php if ($homepage_services): ?>
						<section class="section-services">
							<?php if ($services_section_title): ?>
								<h2 class="section-title"><?php echo $services_section_title; ?></h2><!-- /.section-title -->
							<?php endif ?>

							<ul class="services">
								<?php foreach ($homepage_services as $service): ?>
									<li class="service">
										<?php if ($service['image']): ?>
											<div class="service-image">
												<?php echo wp_get_attachment_image($service['image'], 'homepage-service-image'); ?>
											</div><!-- /.service-image -->
										<?php endif ?>
										
										<?php if ($service['title']): ?>
											<h3><?php echo $service['title']; ?></h3>
										<?php endif ?>
										
										<?php
										if ($service['text']) {
											echo wpautop($service['text']);
										}
										?>
										
										<?php if ($service['link_text'] && $service['link_url']): ?>
											<a href="<?php echo esc_url($service['link_url']); ?>" target="_blank" class="link-more"><?php echo $service['link_text']; ?></a>
										<?php endif ?>
									</li><!-- /.service -->
								<?php endforeach ?>
							</ul><!-- /.services -->
						</section><!-- /.section-services -->
					<?php endif ?>

					<?php get_template_part('fragments/footer-locations'); ?>
				</div><!-- /.content -->
			</div><!-- /.shell -->
		</div><!-- /.main -->

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>