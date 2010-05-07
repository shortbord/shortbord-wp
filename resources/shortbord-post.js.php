<div class="shortbord">
	<script type="text/javascript">
		if(typeof(Shortbord)=='object') {
			var endorsement = Shortbord.getEndorsement('<?php echo md5(get_the_author_meta('email',$_post->post_author)); ?>');
			endorsement.size = <?php echo $settings['post-size']; ?>;
			endorsement.failure_image = '<?php echo $settings['failimage']; ?>';

<?php if($settings['send-content']==1) { ?>
			endorsement.content = "<?php echo urlencode($_post->post_content); ?>";
			endorsement.created_at = '<?php echo get_post_time('Y-m-d\TH:i:s\Z', true, $_post->ID); ?>';
<?php if($settings['privacy']==1) { ?>
			endorsement.public_content = false;
<?php } else { ?>
			endorsement.public_content = true;
<?php } ?>
<?php } ?>

			endorsement.finalize();
		}
	</script>
</div>