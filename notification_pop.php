<?php

?>
<link type="text/css" href="styles.css" rel="stylesheet" media="screen" />



<!--<script src="notify.js"></script>-->
<script src="jQuery.js"></script>
<script>
	


	$(document).ready(function(){
		//add a new style 'foo'
		$.notify.addStyle('foo', {
		html: 
		"<div>" +
		  "<div class='clearfix'>" +
		    "<div class='title' data-notify-html='title'/>" +
		    "<div class='buttons'>" +
		      "<button class='no'>Ok</button>" +
		      "<button class='yes' data-notify-text='button'></button>" +
		    "</div>" +
		  "</div>" +
		"</div>"
		});

		//listen for click events from this style
		$(document).on('click', '.notifyjs-foo-base .no', function() {
		//programmatically trigger propogating hide event
		$(this).trigger('notify-hide');
		});
		$(document).on('click', '.notifyjs-foo-base .yes', function() {
		//show button text
		alert($(this).text() + " clicked!");
		//hide notification
		$(this).trigger('notify-hide');

		});
		$.notify({
  			title: 'Would you like some Foo ?',
  			button: 'Confirm'
		}, { 
  			style: 'foo',
  			autoHide: false,
  			clickToHide: false
		});
	});
</script>