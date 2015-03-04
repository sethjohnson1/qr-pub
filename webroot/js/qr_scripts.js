$( document ).on( "pageinit", function( event ) {
	$( "#userPopup" ).enhanceWithin().popup();  
	$( "#menu" ).enhanceWithin().panel();  
	//formats the Lightbox (and makes it work on iPad!) (although not in use any longer)
	$( ".poppedimg" ).on({
        popupbeforeposition: function() {
           var maxHeight = $( window ).height() - 200 + "px";
            $( 'div[id^="popupcontainer_"]' ).css( "max-height", maxHeight );
			
        }
    });
	
});

$(document).bind("mobileinit", function () {
	$.event.special.swipe.scrollSupressionThreshold=100;
	$.event.special.swipe.durationThreshold = 5000ms;
	$.event.special.swipe.horizontalDistanceThreshold = 2px;
	$.event.special.swipe.horizontalDistanceThreshold = 1000px;
});

