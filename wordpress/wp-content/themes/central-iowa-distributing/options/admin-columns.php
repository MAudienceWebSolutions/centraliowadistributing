<?php
/*
Carbon_Admin_Columns_Manager::modify_columns('post', array('page') )
	->remove( array('date', 'author') )
	->add( array(
		Carbon_Admin_Column::create('Color')
			->set_field('color'),
		Carbon_Admin_Column::create('Thumbnail')
			->set_callback('crb_column_render_post_thumbnail'),
	));
*/