<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($instance['email']); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Size:'); ?></label>
	<select name="<?php echo $this->get_field_name('size'); ?>" id="<?php echo $this->get_field_id('size'); ?>">
		<?php foreach(array(22,32,48,64,120,250) as $size) { ?>
		<option <?php selected($instance['size'], $size); ?> value="<?php echo $size; ?>"><?php printf('%d pixels',$size); ?></option>
		<?php } ?>
	</select>
</p>