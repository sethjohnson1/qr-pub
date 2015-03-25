$( document ).on( "pageinit", function( event ) {
	$( "#menu" ).enhanceWithin().panel();  
	//formats the Lightbox (and makes it work on iPad!) (although not in use any longer)
	$( ".poppedimg" ).on({
        popupbeforeposition: function() {
           var maxHeight = $( window ).height() - 200 + "px";
            $( 'div[id^="popupcontainer_"]' ).css( "max-height", maxHeight );
			
        }
    });
	
});

//only used on the kiosks at the moment, helps the Samsungs a little.. Still sucks
$(document).bind("mobileinit", function () {
	$.event.special.swipe.scrollSupressionThreshold=100;
	$.event.special.swipe.durationThreshold = 5000;
	$.event.special.swipe.horizontalDistanceThreshold = 2;
	$.event.special.swipe.horizontalDistanceThreshold = 1000;
	
	
});


