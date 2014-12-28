$( document ).on( "pageinit", "#qrpage", function( event ) {
	$( "#CodePopUp" ).enhanceWithin().popup();
	$( "#Scorecard" ).enhanceWithin().popup();  
	$( "#userPopup" ).enhanceWithin().popup();  
	$( "#menu" ).enhanceWithin().panel();  
	//$( "#Scorecard" ).popup( "open" );
	//$("[data-role=panel]").panel().enhanceWithin();
	
/*	$('.x').live('change', function() {
        $( "#comments" ).enhanceWithin().popup();  
    });*/
});
