var $ = jQuery;
// Topmenu <ul> replace to <select>
function responsive(mainNavigation) {
	var $ = jQuery;
	var screenRes = $('.body_wrap').width();
	
	if ($('#topmenu select').length == 0) {			  
		/* Replace unordered list with a "select" element to be populated with options, and create a variable to select our new empty option menu */
		$('#topmenu').append('<select class="select_styled" id="topm-select" style="display:none;"></select>');
		var selectMenu = $('#topm-select');

		/* Navigate our nav clone for information needed to populate options */
		$(mainNavigation).children('ul').children('li').each(function () {

			/* Get top-level link and text */
			var href = $(this).children('a').attr('href');
			var text = $(this).children('a').text();

			/* Append this option to our "select" */
			if ($(this).is(".current-menu-item") && href != '#') {
				$(selectMenu).append('<option value="' + href + '" selected>' + text + '</option>');
			} else if (href == '#') {
				$(selectMenu).append('<option value="' + href + '" disabled="disabled">' + text + '</option>');
			} else {
				$(selectMenu).append('<option value="' + href + '">' + text + '</option>');
			}

			/* Check for "children" and navigate for more options if they exist */
			if ($(this).children('ul').length > 0) {
				$(this).children('ul').children('li').not(".mega-nav-widget").each(function () {

					/* Get child-level link and text */
					var href2 = $(this).children('a').attr('href');
					var text2 = $(this).children('a').text();

					/* Append this option to our "select" */
					if ($(this).is(".current-menu-item") && href2 != '#') {
						$(selectMenu).append('<option value="'+href2+'" selected> - '+text2+'</option>');
					} else if (href2 == '#') {
						$(selectMenu).append('<option value="'+href2+'" disabled="disabled"># '+text2+'</option>');
					} else {
						$(selectMenu).append('<option value="'+href2+'"> - '+text2+'</option>');
					}

					/* Check for "children" and navigate for more options if they exist */
					if ($(this).children('ul').length > 0) {
						$(this).children('ul').children('li').each(function () {

							/* Get child-level link and text */
							var href3 = $(this).children('a').attr('href');
							var text3 = $(this).children('a').text();

							/* Append this option to our "select" */
							if ($(this).is(".current-menu-item")) {
								$(selectMenu).append('<option value="' + href3 + '" class="select-current" selected>' + text3 + '</option>');
							} else {
								$(selectMenu).append('<option value="' + href3 + '"> -- ' + text3 + '</option>');
							}

						});
					}
				});
			}
		});
	}
	if(screenRes >= 750){
        $('#topmenu select:first').hide();
        $('#topmenu ul:first').show();      
    }else{
        $('#topmenu ul:first').hide();
        $('#topmenu select:first').show();             
    }

	/* When our select menu is changed, change the window location to match the value of the selected option. */
	$(selectMenu).change(function () {
		location = this.options[this.selectedIndex].value;
	});
}
	
jQuery(document).ready(function($) {

// Remove links outline in IE 7
	$("a").attr("hideFocus", "true").css("outline", "none");

// Styled MultiSelect (listbox of checkboxes)
	if ($(".row").hasClass("field_multiselect")) {		
		$(".mutli_select").click (function() {			
			$(".cusel").removeClass("cuselOpen");
			$(".cusel-scroll-wrap").hide();
			$(this).parent().toggleClass("open");
			$(this).children('.mutli_select_box').css({"width": $(this).width()-3}).jScrollPane({
				showArrows: true, 
				mouseWheelSpeed: 15
			});
		});		
		$('body').click(function() {
			$(".field_multiselect").removeClass("open");
		});			
		$('.field_multiselect, .field_multiselect .select_row').click(function(event){
			event.stopPropagation();
		}); 
	}
	
// style Select, Radio, Checkbox
	if ($("select").hasClass("select_styled")) {
		var deviceAgent = navigator.userAgent.toLowerCase();
		var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
		if (agentID) {
			cuSel({changedEl: ".select_styled", visRows: 8, scrollArrows: true});	 // Add arrows Up/Down for iPad/iPhone
		} else {
			cuSel({changedEl: ".select_styled", visRows: 8, scrollArrows: true});
		}		
	}
	if ($("div,p").hasClass("input_styled")) {
		$(".input_styled input").customInput();
	}

// centering dropdown submenu (not mega-nav)
	$(".dropdown > li:not(.mega-nav)").hover(function(){
		var dropDown = $(this).children("ul");
		var dropDownLi = $(this).children().children("li").innerWidth();		
		var posLeft = ((dropDownLi - $(this).innerWidth())/2);
		dropDown.css("left",-posLeft);		
	});	
	
// reload topmenu on Resize
	var mainNavigation = $('#topmenu').clone();
	responsive(mainNavigation);
	
    $(window).resize(function() {		
        var screenRes = $('.body_wrap').width();
        responsive(mainNavigation);
    });	
	
// responsive megamenu			
	var screenRes = $(window).width();   
	
    if (screenRes < 750) {
		$(".dropdown li.mega-nav").removeClass("mega-nav");		
	} 
	if (screenRes > 750) {				
		mega_show();		
    } 		
	
	function mega_show(){		
		$('.dropdown li').hoverIntent({
			sensitivity: 5,
			interval: 50, 
			over: subm_show, 
			timeout: 0, 
			out: subm_hide
		});
	}
	function subm_show(){	
		if ($(this).hasClass("parent")) {
			$(this).addClass("parentHover");
		};		
		$(this).children("ul.submenu-1").fadeIn(50);		
	}
	function subm_hide(){ 
		$(this).removeClass("parentHover");
		$(this).children("ul.submenu-1").fadeOut(50);		
	}
		
	$(".dropdown ul").parent("li").addClass("parent");
	$(".dropdown li:first-child, .pricing_box li:first-child, .sidebar .widget-container:first-child, .f_col .widget-container:first-child").addClass("first");
	$(".dropdown li:last-child, .pricing_box li:last-child, .widget_twitter .tweet_item:last-child, .sidebar .widget-container:last-child, .f_col .widget-container li:last-child").addClass("last");
	$(".dropdown li:only-child").removeClass("last").addClass("only");	
	$(".sidebar .current-menu-item, .sidebar .current-menu-ancestor").prev().addClass("current-prev");				
	
// tabs		
	if ($("ul").hasClass("tabs")) {		
		$("ul.tabs").tabs("> .tabcontent", {tabs: 'li', effect: 'fade'});	
	}
	if ($("ul").is(".tabs.linked")) {		
		$("ul.tabs").tabs("> .tabcontent", {effect: 'fade'});
	}
	
// odd/even
	$("ul.recent_posts > li:odd, ul.popular_posts > li:odd, .styled_table table>tbody>tr:odd, .boxed_list > .boxed_item:odd, .grid_layout .post-item:odd").addClass("odd");
	$(".widget_recent_comments ul > li:even, .widget_recent_entries li:even, .widget_twitter .tweet_item:even, .widget_archive ul > li:even, .widget_categories ul > li:even, .widget_nav_menu ul > li:even, .widget_links ul > li:even, .widget_meta ul > li:even, .widget_pages ul > li:even, .offer_specification li:even").addClass("even");
	
// cols
	$(".row .col:first-child").addClass("alpha");
	$(".row .col:last-child").addClass("omega"); 	

// toggle content
	$(".toggle_content").hide(); 	
	$(".toggle").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});
	
	$(".toggle").click(function(){
		$(this).next(".toggle_content").slideToggle(300,'easeInQuad');
	});

// pricing
	if (screenRes > 750) {
		// style 2
		$(".pricing_box ul").each(function () {
			$(".pricing_box .price_col").css('width',$(".pricing_box ul").width() / $(".pricing_box .price_col").size() - 10);			
		});
		
		var table_maxHeight = -1;
		$('.price_item .price_col_body ul').each(function() {
			table_maxHeight = table_maxHeight > $(this).height() ? table_maxHeight : $(this).height();
		});
		$('.price_item .price_col_body ul').each(function() {
			$(this).height(table_maxHeight);
		});	
	} 
	
// buttons	
		$(".btn, .post-share a, .btn-submit").hover(function(){
			$(this).stop().animate({"opacity": 0.80});
		},function(){
			$(this).stop().animate({"opacity": 1});
		});	

// Smooth Scroling of ID anchors	
  function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
  }
  var locationPath = filterPath(location.pathname);
  var scrollElem = scrollableElement('html', 'body');
 
  $('a[href*=#].anchor').each(function() {
    $(this).click(function(event) {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $(this.hash), target = this.hash;
      if (target && $target.length != 0) {
        var targetOffset = $target.offset().top;
          event.preventDefault();
          $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
            location.hash = target;
          });
      }
    }
   });	
  });
 
  // use the first element that is "scrollable"
  function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
      var el = arguments[i],
          $scrollElement = $(el);
      if ($scrollElement.scrollTop()> 0) {
        return el;
      } else {
        $scrollElement.scrollTop(1);
        var isScrollable = $scrollElement.scrollTop()> 0;
        $scrollElement.scrollTop(0);
        if (isScrollable) {
          return el;
        }
      }
    }
    return [];
  }
  
	// prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
	if($('a').is('[data-rel]') && screenRes > 600) {
        $('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});		
		$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});	
    }
	  
});

$(window).load(function() {
    var $=jQuery;
// mega dropdown menu	
	$('.dropdown .mega-nav > ul.submenu-1').each(function(){  
		var liItems = $(this);
		var Sum = 0;
		var liHeight = 0;
		if (liItems.children('li').length > 1){
			$(this).children('li').each(function(i, e){
				Sum += $(e).outerWidth(true);
			});
			$(this).width(Sum);
			liHeight = $(this).innerHeight();	
			$(this).children('li').css({"height":liHeight-30});					
		}
		var posLeft = 0;
		var halfSum = Sum/2;
		var screenRes = $(window).width();	
		if (screenRes > 960) {
			var mainWidth = 940; // width of main container to fit in.
		} else {
			var mainWidth = 744; // for iPad.
		}
		var parentWidth = $(this).parent().width();			
		var margLeft = $(this).parent().position();		
		margLeft = margLeft.left;		
		var margRight = mainWidth - margLeft - parentWidth;		
		var subCenter = halfSum - parentWidth/2;						
		if (margLeft >= halfSum && margRight >= halfSum) {			
			liItems.css("left",-subCenter);
		} else if (margLeft<halfSum) {
			liItems.css("left",-margLeft-1);
		} else if (margRight<halfSum) {
			posLeft = Sum - margRight - parentWidth - 10;
			liItems.css("left",-posLeft);					
		}
	});	
});