<?php echo $before_widget;?>
<?php if(!empty($instance['title'])) { ?>
<?php echo $before_title.apply_filters('widget_title',$instance['title']).$after_title; ?>
<?php } ?>
<div class="shortbord-widget">
	<script type="text/javascript">
		if(typeof(Shortbord)=='object') {
			var endorsement = Shortbord.getEndorsement('<?php echo md5($instance['email']); ?>');
			endorsement.size = <?php echo $instance['size']; ?>;
			endorsement.finalize();
		}
	</script>
</div>
<?php echo $after_widget; ?>