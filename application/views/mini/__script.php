<script type="text/javascript" src="<?php echo base_url('/public/' . PATH) ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('/public/' . PATH) ?>js/all_minify.min.js"></script>
<script type="text/javascript">
	jQuery(function() {
		jQuery('.iosSlider').iosSlider({
			snapToChildren: true,
			desktopClickDrag: true,
			keyboardControls: false,
			infiniteSlider: true,
			navNextSelector: jQuery('.iosSlider .next'),
			navPrevSelector: jQuery('.iosSlider .prev')
		});
		if (jQuery('.iosSlider .item').length < 2) {
			jQuery('.iosSlider .controls').remove();
		}
	});
</script>
<script>
	$(function() {
		$("#datepicker").datepicker();
	});
</script>