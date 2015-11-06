<?php
$social_fields = array();

$social_fields[] = Carbon_Field::factory('separator', 'socials_sep', __('Socials', 'crb'));
$social_fields[] = Carbon_Field::factory('text', 'crb_socials_title', __('Title', 'crb'))->set_default_value('Follow Us');

foreach (crb_get_social_sites() as $id => $name) {
	$social_fields[] = 	Carbon_Field::factory('text', 'crb_' . $id, __($name . ' Link', 'crb'));
}

Carbon_Container::factory('theme_options', __('Theme Options', 'crb'))
	->add_fields(array_merge(array(
		// Header
		Carbon_Field::factory('separator', 'header_sep', __('Header', 'crb')),
		Carbon_Field::factory('attachment', 'crb_header_logo', __('Logo', 'crb')),
		Carbon_Field::factory('rich_text', 'crb_header_text', __('Right Side Text', 'crb')),

		// Footer
		Carbon_Field::factory('separator', 'footer_sep', __('Footer', 'crb')),
		Carbon_Field::factory('text', 'crb_footer_locations_title', __('Locations Title', 'crb'))->set_default_value('Locations:'),
		Carbon_Field::factory('complex', 'crb_footer_locations', __('Locations', 'crb'))
			->add_fields(array(
				Carbon_Field::factory('rich_text', 'text', __('Text', 'crb')),
			)),

		// Scripts
		Carbon_Field::factory('separator', 'misc_options_sep', __('Misc Options', 'crb')),
		Carbon_Field::factory('header_scripts', 'crb_header_script', __('Header Script', 'crb')),
		Carbon_Field::factory('footer_scripts', 'crb_footer_script', __('Footer Script', 'crb')),
	), $social_fields));

if ( carbon_twitter_widget_registered() ) {
	Carbon_Container::factory('theme_options', 'Twitter Settings')
		->set_page_parent('Theme Options')
		->add_fields(array(
			Carbon_Field::factory('html', 'crb_twitter_settings_html')
				->set_html('
					<div style="position: relative; background: #fff; border: 1px solid #ccc; padding: 10px;">
						<h4><strong>' . __('Twitter API requires a Twitter application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:', 'crb') . '</strong></h4>
						<ol style="font-weight: normal;">
							<li>' . sprintf(__('Go to <a href="%1$s" target="_blank">%1$s</a> and log in, if necessary.', 'crb'), 'https://dev.twitter.com/apps/new') . '</li>
							<li>' . __('Supply the necessary required fields and accept the <strong>Terms of Service</strong>. <strong>Callback URL</strong> field may be left empty.', 'crb') . '</li>
							<li>' . __('Submit the form.', 'crb') . '</li>
							<li>' . __('On the next screen, click on the <strong>Keys and Access Tokens</strong> tab.', 'crb') . '</li>
							<li>' . __('Scroll down to <strong>Your access token</strong> section and click the <strong>Create my access token</strong> button.', 'crb') . '</li>
							<li>' . __('Copy the following fields: <strong>Consumer Key, Consumer Secret, Access Token, Access Token Secret</strong> to the below fields.', 'crb') . '</li>
						</ol>
					</div>
				'),
			Carbon_Field::factory('text', 'crb_twitter_consumer_key', __('Consumer Key', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_consumer_secret', __('Consumer Secret', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token', __('Access Token', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token_secret', __('Access Token Secret', 'crb'))
				->set_default_value(''),
		));
}