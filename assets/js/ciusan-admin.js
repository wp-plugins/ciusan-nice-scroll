jQuery(document).ready(function ($) {

	jQuery(document).ready(function() {
		jQuery(".ciusan-success-messages").fadeOut(5000);
	});

	jQuery(document).ready(function() {
		jQuery('.CNS-info').each(function() {
			jQuery(this).qtip({
				content: {
					text: jQuery(this).next('small.help'),
				}
			});
		});
	});

});