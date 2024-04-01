jQuery(function($){
	var state = false;
	var scrollpos = 0;
	function mm_control() {
		if($('.mean-nav .menu').is(':visible')) {
			if(state == false) {
				scrollpos = $(window).scrollTop();
				$('body').addClass('fixed').css({'top': -scrollpos});
				$('.mean-container').addClass('open');
				$('.mean-nav .mask').show();
				state = true;
			}
		} else {
			if(state == true) {
				$('body').removeClass('fixed').css({'top': 0});
				window.scrollTo( 0 , scrollpos );
				$('.mean-container').removeClass('open');
				$('.mean-nav .mask').hide();
				state = false;
			}
		}
	}

	$('#gNav').meanmenu({
	    meanMenuContainer: "#header .h_nav",
	    meanScreenWidth: "768"
	});
	$(document)
	.on('opend.meanmenu closed.meanmenu', function() {
		mm_control();
	})
	.on('touchend click', '.mean-bar .mask', function(e) {
		$('.mean-bar .meanmenu-reveal').trigger('click');
		return false;
	});
	$(window).on('resize', function() {
		mm_control();
	});
});

jQuery(window).on('load', function() {
  var headerHight = 100;
  if(document.URL.match("#")) {
  var str = location.href ;
  var cut_str = "#";
  var index = str.indexOf(cut_str);
  var href = str.slice(index);
  var target = href;
  var position = jQuery(target).offset().top - headerHight;
  jQuery("html, body").scrollTop(position);
  return false;
}

});