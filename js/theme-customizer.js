(function($){
	wp.customize("facebook", function(value) {
		value.bind(function(newval) {
			$(".facebook").html(newval);
		} );
	});
})(jQuery);