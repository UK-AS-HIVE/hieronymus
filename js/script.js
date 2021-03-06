(function($){
  $(document).ready(function(){

	console.log('on stage');

	var sliderArray = [];

	// Class for Slider Objects
	var sliderObj = function(obj,index){
	  //store obj
	  this.index = index;
	  this.slider = obj;
	  
	  //store arrow references
	  this.arrowforward =  $('.visible-arrows').has(this.slider).find('.forward-arrow').get()[0]
	  this.arrowbackward = $('.visible-arrows').has(this.slider).find('.back-arrow').get()[0]
	  this.mouseOver = false;
	  //slider state
	  this.autoscroll = ($(".auto-slider").has(this.slider).length > 0);
	  this.page = 1;
	  this.maxSlidesCount = 1;  //max number of slides for this slider, set by class name in below function
	  this.curSlidesCount = 1;  //current number of slides that can fit in the slider
	  this.maxPageNum = 1;      //
	  this.galleryLength = 1;   //number of slides
	  this.galleryLengthRounded = 1;//number of slides rounded up to multiple of curSlidesCount
	  
	  //setup only runs once per slider per pageload
	  this.setup = function(){
		
		//look through all the classes in this.slider for slide-#, set # to maxSlidesCount.
		var sliderClassList = $(this.slider).attr('class').split(' ')
		for(i in sliderClassList){
		  if (sliderClassList[i].match(/slide-\d/g) != null) {
			this.maxSlidesCount = sliderClassList[i].substr(sliderClassList[i].length-1);
		  }
		}
		$(this.slider).attr("data-index",this.index)
		
		this.update()
		
		$(this.arrowforward).unbind("click").click(this.forwardArrowClick);
		$(this.arrowbackward).unbind("click").click(this.backwardArrowClick);
		$(".auto-slider").has(this.slider).mouseover(this.sliderMouseOver).mouseout(this.sliderMouseOut);
	  }
	  this.update = function(){
		this.galleryLength=$(this.slider).find(".views-row").length;

		if (this.maxSlidesCount == '1') this.updateSingle();
		else this.updateSlider();
		
		//update slider arrows.
		if(this.page >= this.maxPageNum) {
		  $(this.arrowforward).css({'color' : '#d0d0d0', 'pointer-events' : 'none'});
		}else{
		  $(this.arrowforward).css({'color' : '#005daa', 'pointer-events' : 'auto'});
		}
		if(this.page == 1) {
		  $(this.arrowbackward).css({'color' : '#d0d0d0', 'pointer-events' : 'none'});
		}else if(this.page > 1) {
		  $(this.arrowbackward).css({'color' : '#005daa', 'pointer-events' : 'auto'});
		}
		if(1 >= this.maxPageNum){
		  $(this.arrowforward).css({"opacity":"0"})
		  $(this.arrowbackward).css({"opacity":"0"})
		}else{
		  $(this.arrowforward).css({"opacity":"1"})
		  $(this.arrowbackward).css({"opacity":"1"})
		}
		
		$(this.arrowforward).unbind("click").click(this.forwardArrowClick);
		$(this.arrowbackward).unbind("click").click(this.backwardArrowClick);
		
		if(this.autoscroll){this.autoscrollSetup();}
		this.moveSlider()
		
	  }
	  this.updateSlider = function(){
		var maxWidth = 1200; //the max width of the main content wrapper
		var minColumnWidth = 0.95; //percent of the slider as compared to the full content wrapper width
		//find the correct value for curSlidesCount by decreasing till you find one that fits. minimum 1
		this.curSlidesCount = this.maxSlidesCount;//assume cur should be max by default.
		while (this.curSlidesCount > 1 && ($(window).width()/this.curSlidesCount) < (maxWidth * minColumnWidth)/this.maxSlidesCount) {
		  this.curSlidesCount--;
		  //i dont know what this next line does but it doesnt look like it belongs here so im commenting it
		  //$('.view-content').css('left', 0 + "%"); 
		  $(this.slider).attr('data-page', 1);
		}
		
		//finding the max page number of slider depending on number of columns
		this.maxPageNum=Math.ceil(this.galleryLength/this.curSlidesCount); 

		//Rounding number of gallery elements to nearest multiple of number of columns
		this.galleryLengthRounded = this.maxPageNum*this.curSlidesCount; 
		
		//Setting width of slider using maxPageNum as a percentage. or actually no clue...
		$(this.slider).find('.view-content').css('width', this.maxPageNum * 100 + '%'); 
		$(this.slider).find('.views-row').css('width', (100/this.galleryLengthRounded) + '%');

		//when page resizes, while the current page number exceeds the max page number i trigger clicking the back arrow
		while(this.page>this.maxPageNum){
		  this.page -= 1;
		}
	  }
	  this.updateSingle = function() {
		// Single sliders don't deal with changing slide counts
		this.curSlidesCount = this.maxSlidesCount;
		this.maxPageNum = this.galleryLength;
		this.galleryLengthRounded = this.galleryLength;
	  }
	  
	  this.forwardArrowClick = function(){
		var that = (sliderArray[Number($(this).parent().find(".slide").attr("data-index"))])
		if(that.page < that.maxPageNum) {
		  that.page += 1;
		  
		}
		that.update()
	  }
	  this.backwardArrowClick = function(){
		var that = (sliderArray[Number($(this).parent().find(".slide").attr("data-index"))])
		if(that.page > 1) {
		  that.page -= 1;
		}
		that.update()
	  }
	  this.sliderMouseOver = function(){
		var that = (sliderArray[Number($(this).find(".slide").attr("data-index"))])
		that.mouseOver = true
	  }
	  this.sliderMouseOut = function(){
		var that = (sliderArray[Number($(this).find(".slide").attr("data-index"))])
		that.mouseOver = false
	  }
	  
	  this.autoscrollSetup = function(){
		$(this.arrowbackward).toggle(false);
		$(this.arrowforward).toggle(false);
		this.createScrollIndicator()
		
	  }
	  this.scrollOne = function(){
		if(!this.autoscroll){return;}
		if(this.mouseOver){return;}
		if(this.page != this.maxPageNum){
		  this.page += 1;
		}else{
		  
		  this.page = 1;
		}
		this.moveSlider()
		
	  }
	  this.moveSlider = function(){
		if (this.maxSlidesCount != '1') {
		  var move=100*(this.page-1);
		  $('.visible-arrows').has(this.slider).find('.view-content').css('left', -move + "%");
		}
		else {
		  $(this.slider).find(".views-row").removeClass('slider-active');
		  $(this.slider).find(".views-row:nth-child("+this.page+")").addClass('slider-active');
		}

		if(this.autoscroll){
		  $(".dynamic-scroll-indicator-bubble-selected").removeClass("dynamic-scroll-indicator-bubble-selected")
		  $(this.slider).parent().find(".dynamic-scroll-indicator").find("[data-page-indicator="+this.page+"]").addClass("dynamic-scroll-indicator-bubble-selected")
		}
	  }
	  this.createScrollIndicator = function(){
		$(this.slider).parent().find(".dynamic-scroll-indicator").remove()
		var scrollIndicator = document.createElement("div")
		$(scrollIndicator).addClass("dynamic-scroll-indicator")
		for(var i=1;i<=this.maxPageNum;i++){
		  var scrollIndicatorBubble = document.createElement("div")
		  $(scrollIndicatorBubble).attr("data-page-indicator",i).addClass("indicator-bubble")
		  $(scrollIndicatorBubble).unbind("click").click(function(){
			var that = (sliderArray[Number($(this).parent().parent().find(".slide").attr("data-index"))])
			that.page = Number($(this).attr("data-page-indicator"))
			that.moveSlider()
		  })
		  $(scrollIndicator).append(scrollIndicatorBubble)
		}
		$(this.slider).parent().append(scrollIndicator)
	  }
	  
	  //maybe not needed
	  this.hideArrows = function(n){
		if(n!=1)
		  $(this.arrowbackward).toggle(false);
		if(n!=0)
		  $(this.arrowforward).toggle(false);
	  }

	  this.hideEmptyRows = function() {
		if ($(this.slider).find('.views-row').length == 0 && $(this.slider).parents('.row-tabs').length == 0) {
			var fieldItem = $(this.slider).parents('.field-item');
			fieldItem.hide();
			if (fieldItem.next().find('.more-button').length == 1) {
				fieldItem.next().hide();
			}

		}
		else {
			console.log('wont hide');
		}
	  };
	  this.hideEmptyRows(); 

	  this.setup()
	}
	
	function doesTabs(){
		//for each tab wrapper
		$('ul.tabbed').each(function(tabwrappercounter,e) {
			//reset tab wrapper menu state so that width calculations
			//can take placesince the width changes if its a menu.
			$(this).parent().removeClass("tab-menu")
			
			var tabs = $(this).find('li');
			
			var menumode = false;
			
			//calculate the width of the individual tabs in the tab wrapper ul
			//the "- 1" is a hacky solution to the li elements flowing into the next row.
			var tabWidth = (($(this).width())/tabs.length) - 1;
			
			//create a test div at the bottom of the body to measure the length of the text
			//inside each tab. this is the only way to test if the text in the tab is larger 
			//than the tab itself and perfectly detects whether it needs to be menu mode.
			tabs.each(function() {
			  //create, style, addclass for deletion, append, and test the width and compare
			  var textTest = document.createElement("div")
			  $(textTest).css({
				"font-size": "35px",
				"font-family": "'Roboto', sans-serif",
				"text-transform": "uppercase",
				"visibility": "hidden",
				"white-space": "nowrap",
				"position": "absolute",
				"height": "auto",
				"width": "auto",
			  })
			  $(textTest).addClass("this-shouldbe-deleted-its-a-test")
			  $(textTest).text($(this).children().text())
			  $("body").append(textTest)
			  if((tabWidth-10)<=$(textTest).width()){menumode = true}
			})
			$(".this-shouldbe-deleted-its-a-test").remove()
			
			if(menumode){
			  $(this).parent().addClass("tab-menu")
			}else{
			  $(tabs).css('width', tabWidth);
			}
			
			//if tab wrapper is in menu mode add class to style as a menu
			$(".tab-wrapper.tab-menu").unbind("click").click(function(e){
			  if($(this).hasClass("tab-menu-open")){
				$(".tab-wrapper.tab-menu").removeClass("tab-menu-open")
			  }else{
				$(".tab-wrapper.tab-menu").removeClass("tab-menu-open")
				$(this).addClass("tab-menu-open")
			  }
			})
			
			var tabCounter = 1;
			var tabContentCounter = 1;

			var tabWrapperContainer = $('.tab-all-wrapper').has($(this));

			$(this).find('li:first-of-type').addClass('current');
			tabWrapperContainer.find('.tab-content div:first-of-type').addClass('current');
			
			tabs.each(function() {
				$(this).attr("data-tab", tabCounter);
				tabCounter++; 
			});
			
			tabWrapperContainer.find('.tab-content > div').each(function() {
				$(this).attr('data-tab', tabContentCounter);
				tabContentCounter++;
			})

			tabs.click(function(e){   
			  //Tab buttons classes to change header
			  tabs.removeClass('current');
			  $(this).addClass('current');
			  
			  //Tab content switching
			  tabWrapperContainer.find('.tab-content div').removeClass('current');
			  var dataTabNumber = $(this).attr('data-tab');
			  tabWrapperContainer.find('.tab-content div[data-tab="' + dataTabNumber + '"]').addClass('current');
			  
			  setTabHeader(this)
			  
			});
			tabs.each(function() {
				setTabHeader(this)
			});
			
		});
	};
	function fieldSet() {
		$('.expandable').each(function() {
			var fieldHeight = 0;
			var wrapperChildren = $(this).find('.fieldset-wrapper').children().get()
			
			for(i in wrapperChildren){
			  fieldHeight += $(wrapperChildren[i]).outerHeight(true)
			}
			
			//since its updated on page resize i need to set initial condition
			if (!$(this).hasClass('expanded')) {
			  $(this).children('.fieldset-wrapper').hide();
			}

			//toggles ".expandable>.feildset-wrapper" max-height between 0 and feildHeight on click.
			$(this).children('legend').unbind("click").click(function() {
			  $(this).parent().toggleClass('expanded');
			  $(this).siblings('.fieldset-wrapper').slideToggle(500);
			});
			

		});
	}
	function setTabHeader(that){
	  //if the tab being sent to this function is not selected, ignore
	  if(!$(that).hasClass("current")){return;}
	  
	  //remove all tab headers
	  $(".tab-wrapper").has(that).find(".tab-current-header").remove()
	  
	  //if tab wrapper is not in menu mode, ignore
	  if(!$(".tab-wrapper").has(that).hasClass("tab-menu")){return;}
	  
	  //create header, give it a class for styling/removing, fill it with text, aaannnd.......... append
	  var tabContent = document.createElement("h2")
	  $(tabContent).addClass("tab-current-header")
	  $(tabContent).text($(that).find("h2").html())
	  $(".tab-wrapper").has(that).append(tabContent)
	}
	function onResize(){
	  for(i in sliderArray){sliderArray[i].update();}
	  doesTabs();
	}
	function startup(){
	  // Contact Form
	  $('input, textarea').focus(function(){
		$(this).removeClass('edited');
	  }).blur(function(){
		  $(this).addClass('edited');
		  if ($('form:valid').length > 0) {
			  $('form:valid').addClass('valid');
		  }
		  else {
			  $('form.valid').removeClass('valid');
		  }
	  });
	  fieldSet();
	  doesTabs();
	  
	  for(i in $('.slide').get()){
		sliderArray[i] = new sliderObj($('.slide').get()[i],i)
	  }

	  $(window).resize(onResize);
	}
	setInterval(function(){
	   for(i in sliderArray) {
	   	 sliderArray[i].scrollOne();
	   }
	},7000);
	startup();
  });
})(jQuery)
