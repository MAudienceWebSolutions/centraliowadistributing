<form role="search" method="get" action="<?php echo home_url('/'); ?>">
	<label for="s" class="hidden"><?php _e('Search', 'crb'); ?></label>
	<input type="search" name="s" id="s" value="" placeholder="Search" class="search-field">
	<input type="submit" value="<?php echo esc_attr(__('GO', 'crb')); ?>" class="search-btn">
</form>
