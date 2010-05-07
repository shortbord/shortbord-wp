<?php $settings = $this->getSettings(); ?>
<?php if($_GET['updated']=='true') { ?>
<div id="shortbord-settings-message" class="updated">
	<p><strong><?php _e('Settings saved'); ?></strong></p>
</div>
<?php } ?>
<div class="wrap">
	<h2><?php _e('Shortbord'); ?></h2>
	<form method="post" enctype="multipart/form-data">

		<h3><?php _e('Shortbord Settings'); ?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="shortbord-partner"><?php _e('Partner ID'); ?></label></th>
					<td>
						<input type="text" class="regular-text" name="shortbord[partner]" id="shortbord-partner" value="<?php esc_attr_e($settings['partner']); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="shortbord-size"><?php _e('Comment Size'); ?></label></th>
					<td>
						<select name="shortbord[size]" id="shortbord-size">
							<?php foreach(array(22,32,48,64,120,250) as $size) { ?>
							<option <?php selected($settings['size'], $size); ?> value="<?php echo $size; ?>"><?php printf('%d pixels',$size); ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="shortbord-post-size"><?php _e('Post Title Size'); ?></label></th>
					<td>
						<select name="shortbord[post-size]" id="shortbord-post-size">
							<?php foreach(array(22,32,48,64,120,250) as $size) { ?>
							<option <?php selected($settings['post-size'], $size); ?> value="<?php echo $size; ?>"><?php printf('%d pixels',$size); ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="shortbord-failimage"><?php _e('Default Image'); ?></label></th>
					<td>
						<select name="shortbord[failimage]" id="shortbod-failimage">
							<option <?php selected($settings['failimage'], ''); ?> value=""><?php _e('Shortbord Logo'); ?></option>
							<option <?php selected($settings['failimage'], 'none'); ?> value="none"><?php _e('None'); ?></option>
							<option <?php selected($settings['failimage'], 'fullsize'); ?> value="fullsize"><?php _e('Transparent Image'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Send Content'); ?></th>
					<td>
						<label>
							<input <?php checked($settings['send-content'],1); ?> type="checkbox" name="shortbord[send-content]" id="shortbord-send-content" value="1" />
							<?php _e('Allow the Shortbord plugin to send post and comment contents')?>
						</label>
					</td>
				</tr>
				<tr id="comment-privacy">
					<th scope="row"><?php _e('Content Privacy'); ?></th>
					<td>
						<label>
							<input <?php checked($settings['privacy'],1); ?> type="checkbox" name="shortbord[privacy]" id="shortbord-privacy" value="1" />
							<?php _e('Content sent should be considered private')?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<h3><?php _e('Implementation Settings'); ?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php _e('Comment Insertion')?></th>
					<td>
						<label>
							<input <?php checked($settings['method'],'automatic'); ?> type="radio" name="shortbord[method]" id="shortbord-method-automatic" value="automatic" />
							<?php _e('I want the Shortbord plugin to automatically insert the Shortbord endorsement into users\' comments'); ?>
						</label><br />
						<label>
							<input <?php checked($settings['method'],'manual'); ?> type="radio" name="shortbord[method]" id="shortbord-method-manual" value="manual" />
							<?php _e('I will use the custom template tag <code>the_comment_shortbord()</code> in my comment template (<strong>Advanced Users Only</strong>)'); ?>
						</label>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Post Title Insertion')?></th>
					<td>
						<label>
							<input <?php checked($settings['title-method'],'automatic'); ?> type="radio" name="shortbord[title-method]" id="shortbord-title-method-automatic" value="automatic" />
							<?php _e('I want the Shortbord plugin to automatically insert a post author\'s Shortbord endorsement next to the title'); ?>
						</label><br />
						<label>
							<input <?php checked($settings['title-method'],'manual'); ?> type="radio" name="shortbord[title-method]" id="shortbord-title-method-manual" value="manual" />
							<?php _e('I will use the custom template tag <code>the_post_shortbord()</code> in my post template (<strong>Advanced Users Only</strong>)'); ?>
						</label>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="shortbord-styling"><?php _e('Styling'); ?></label></th>
					<td>
						<textarea rows="7" class="large-text code" name="shortbord[styling]" id="shortbord-styling"><?php esc_html_e($settings['styling']); ?></textarea><br />
						<?php _e('Enter some CSS in the above textarea to style the Shortbord endorsement.  If you don\'t want to use this capability, simply delete everything in the textarea.'); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<?php wp_nonce_field('save-shortbord-settings'); ?>
			<input type="submit" class="button-primary" name="save-shortbord-settings" id="save-shortbord-settings" value="<?php _e('Save Settings'); ?>" />
		</p>
	</form>
</div>