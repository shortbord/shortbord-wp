<div class="shortbord">
	<script type="text/javascript">
		if(typeof(Shortbord)=='object') {
			var endorsement = Shortbord.getEndorsement('<?php echo md5($_comment->comment_author_email); ?>');
			endorsement.size = <?php echo $settings['size']; ?>;
			endorsement.failure_image = '<?php echo $settings['failimage']; ?>';

<?php if($settings['send-content']==1) { ?>
			endorsement.content = "<?php echo urlencode($_comment->comment_content); ?>";
			endorsement.created_at = '<?php echo get_comment_time('Y-m-d\TH:i:s\Z', true, $_comment->comment_ID); ?>';
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