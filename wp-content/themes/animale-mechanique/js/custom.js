/*theme scripts*/
jQuery(document).ready(function($){
	/* Zurb Foundation Navigation activation */
	$(document).foundationNavigation();
	
	jQuery(window).load(function(){
		$('.window-box').each(function(){
		windowBox($(this), $(this).attr('data-targetWidth'),$(this).attr('data-targetHeight'));
		
		});

	function fadeStuff(){
		$('#header').animate({'opacity':1}, 1000);
		$('.wrap-header').delay(800).animate({'opacity':1}, 1000);
		
		$('#content-wrapper').css({'background-size': '100%'});
		$('#content-wrapper').delay(1600).animate({'min-height': 350}, 1000, function(){
		$('.wrap-footer').animate({'opacity':1}, 1000);
		$('#content-wrapper').css({'background-size': 'contain', 'height':'auto'});
		$('.content-padding').animate({'opacity':1}, 1000);
		});
		
		$('.ponies').delay(2000).animate({'opacity':1}, 1000);
		
		}
	fadeStuff();
		/* Isotope Activation */
	// cache container
	var $container = $('.filter-target');
	// initialize isotope
	if($container.length > 0){
	$container.isotope({
		'layoutMode' : 'fitRows'
	  // options... http://isotope.metafizzy.co/docs/options.html
	});
	}
	var $container = $('.partners .filter-target');
	// initialize isotope
	if($container.length > 0){
	$container.isotope({
		'layoutMode' : 'masonry'
	  // options... http://isotope.metafizzy.co/docs/options.html
	});
	
	}//endif
	// filter items when filter link is clicked
	$('.filter-menu a').click(function(){
	  var selector = $(this).attr('data-filter');
	  $(this).parent().parent('.filter-menu').nextAll('.filter-target').first().isotope({ filter: selector });
	  return false;
	});
	//End isotope activation scripts
	
	/* smooth scrolling for local links */
	$.localScroll();
	
	function windowBox(windowBox, boxWidth, boxHeight){
	var $this = $(windowBox);
	console.log($this);
	var $imgSrc = $this.attr('src');
	var $imgWidth = $this.attr('width');
	var $imgHeight = $this.attr('height');
	var $boxWidth = boxWidth;
	var $boxHeight = boxHeight;
	
	console.log($imgSrc, ' - imgSrc ',$imgWidth,' - imgWidth ',$imgHeight,' - imgHeight ', $boxWidth,' - boxWidth ', $boxHeight,' - boxHeight');
	var $boxID = $this.attr('id');
	$this.replaceWith('<div class="window-box-rendered" id="'+ $boxID +'"></div>');
	windowBox = $('#'+$boxID+'.window-box-rendered');
	windowBox.css({'backgroundImage':'url('+$imgSrc+')', 'height':boxHeight, 'width':boxWidth, 'background-position':'center center'});
	
	windowBox.mousemove(function(e){//hover enter function
	//window x goes from 0 to -($imgWidth-boxWidth);
	//mouse x goes from 0 to boxWidth;
	//so boxWidth * multiplier = 0-($imgWidth);
	// (0-$imgWidth)/boxWidth = multiplier;
	//bg_pos =  ((0-($imgWidth-boxWidth))/boxWidth) * (e.offsetX)
	//window y goes from 0 to -$imgHeight;
	//mouse y goes from 0 to box y;
	windowBox.css('background-position-x',  ((0-($imgWidth-boxWidth))/boxWidth) * (e.offsetX));
	windowBox.css('background-position-y', ((0-($imgHeight-boxHeight))/boxHeight) * (e.offsetY));
	
	});
	windowBox.mouseleave(function(e){
	windowBox.css('background-position-x', boxWidth/2-($imgWidth/2));
	windowBox.css('background-position-y', boxHeight/2-($imgHeight/2));
	});
	}
});//end document ready

});