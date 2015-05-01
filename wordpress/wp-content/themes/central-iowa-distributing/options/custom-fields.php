<?php
Carbon_Container::factory('custom_fields', __('Homepage Slider', 'crb'))
	->show_on_post_type('page')
	->show_on_template('templates/home.php')
	->add_fields(array(
		Carbon_Field::factory('complex', 'crb_homepage_slider', __('', 'crb'))->add_fields(array(
				Carbon_Field::factory('attachment', 'image', 'Image')
					->set_required(true),
				Carbon_Field::factory('text', 'text', 'Text'),
			)),
	));

Carbon_Container::factory('custom_fields', __('Featured Products', 'crb'))
	->show_on_post_type('page')
	->show_on_template('templates/home.php')
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_hp_products_section_title', __('Title', 'crb'))->set_default_value('Featured Products'),
		Carbon_Field::factory('relationship', 'crb_homepage_featured_products', __('Select 3 products', 'crb'))
			->set_post_type('product')
			->help_text('Limit 3 products'),
	));

Carbon_Container::factory('custom_fields', __('Homepage Services Section', 'crb'))
	->show_on_post_type('page')
	->show_on_template('templates/home.php')
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_services_section_title', __('Section Title', 'crb')),
		Carbon_Field::factory('complex', 'crb_homepage_services', __('', 'crb'))
			->add_fields(array(
				Carbon_Field::factory('attachment', 'image', 'Image'),
				Carbon_Field::factory('text', 'title', 'Title'),
				Carbon_Field::factory('rich_text', 'text', 'Text'),
				Carbon_Field::factory('text', 'link_text', 'Link Text')->set_default_value('More Details'),
				Carbon_Field::factory('text', 'link_url', 'Link Url'),
			)),
	));