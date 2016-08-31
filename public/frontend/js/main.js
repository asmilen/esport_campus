jQuery(document).ready(function($) {
	// preload image function
	function preload(arrayOfImages) {
		$(arrayOfImages).each(function(){
			$('<img/>')[0].src = this;
		});
	}

	$(document).ready(function(){

	  // set up radio boxes
		$('.radioholder').each(function(){
			$(this).children().hide();
			var description = $(this).children('label').html();
			$(this).append('<span class="desc">'+description+'</span>');
			$(this).prepend('<span class="tick"></span>');
			// on click, update radio boxes accordingly
			$(this).click(function(){
				$(this).children('input').prop('checked', true);
				$(this).children('input').trigger('change');
			});
		});
		// update radio holder classes when a radio element changes
		$('input[type=radio]').change(function(){
	    $('input[type=radio]').each(function(){
	      if($(this).prop('checked') == true) {   
	        $(this).parent().addClass('activeradioholder');
	      }
				else $(this).parent().removeClass('activeradioholder');
			});
		});
		// manually fire radio box change event on page load
		$('input[type=radio]').change();

		
		// preload hover images
	  preload([
	    'http://supereightstudio.com/img/radio_tick.png'
	  ]);

	});
});