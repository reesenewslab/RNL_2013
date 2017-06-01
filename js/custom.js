jQuery(document).ready(function(){
	jQuery('.current-menu-item').addClass('active');
	jQuery('.bottom-right').animate({
		bottom: '1em'
	},1000);

});

jQuery('.btn-navbar').click( function() {
      jQuery('html').toggleClass('expanded');
    });


// SET HEIGHT FOR SPANS
function size_spans(){
  if(jQuery(window).width() > 767){
    jQuery('.repeated-stories').each(function(){
	var span_height = 0;
	var thisid = jQuery(this).attr('id');
	jQuery('#'+thisid).find('.span4').each(function(){
		var new_height = jQuery(this).height();
		if(new_height > span_height){span_height = new_height};
	});

	jQuery('#'+thisid).find('.span4').height(span_height);
    });

    

    /*jQuery('.repeated-stories').each(function(){
    var thisid = jQuery(this).attr('id');
    var span_height = 0;
    jQuery('#'+thisid).children('span4').each(function(){
      var new_height = jQuery(this).height();
      if(new_height > span_height){span_height = new_height;}
      
    });
    console.log(thisid);
    console.log(span_height);
    jQuery('#'+thisid).find('.span').height(span_height);
    //jQuery(thisid).children('.span4').height(span_height);
    var span_height = 0;
  });*/
  }
  
}


jQuery(".bottom-right").click(function(e){
	jQuery('html, body').animate({scrollTop:jQuery('section').eq(2).offset().top - 20}, 1400);
	jQuery(this).hide();
});

// SET HEIGHT FOR pDATE
function date_height(){
  var date_height = jQuery('.date').height();
  jQuery('.content_title').css('min-height',date_height);
}

//something.val(something.val() == 'string1' ? 'string2' : 'string1');
jQuery('li.expand_contract').click(function(){
  jQuery('#sidebar').toggleClass('expanded');
  jQuery('.expand_contract i').toggleClass('icon-chevron-right').toggleClass('icon-chevron-left');
})

jQuery('#nav').scrollspy();

jQuery('#comment_button').addClass('btn');

jQuery(document).ready(size_spans);
jQuery(document).ready(date_height);

jQuery(document).ready(
	function(){
		var height = jQuery('#top-story-container').height();
		jQuery('#top-story-image').css('max-height',height);
	}
);
