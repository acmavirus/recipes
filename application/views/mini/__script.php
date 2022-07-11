<script type="text/javascript" src="<?php echo base_url('/public/' . PATH) ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('/public/' . PATH) ?>js/jquery.common.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('/public/' . PATH) ?>js/site.js"></script>
<script type="text/javascript" src="<?php echo base_url('/public/' . PATH) ?>js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url('/public/' . PATH) ?>js/plugins/jquery.iosslider.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
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