$( document ).on( "pageinit", function( event ) {
	$( "#CodePopUp" ).enhanceWithin().popup();
	$( "#Scorecard" ).enhanceWithin().popup();  
	$( "#userPopup" ).enhanceWithin().popup();  
	$( "#menu" ).enhanceWithin().panel();  
	//$( "#Scorecard" ).popup( "open" );

	//formats the Lightbox (and makes it work on iPad!) (although not in use any longer)
	$( ".poppedimg" ).on({
        popupbeforeposition: function() {
           var maxHeight = $( window ).height() - 200 + "px";
            $( 'div[id^="popupcontainer_"]' ).css( "max-height", maxHeight );
			
        }
    });
	
});
