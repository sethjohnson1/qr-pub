$( document ).on( "pageinit", "#qrpage", function( event ) {
    $( "#CodePopUp" ).enhanceWithin().popup();
    $( "#Scorecard" ).enhanceWithin().popup();  
    $( "#menu" ).enhanceWithin().panel();  
	//$("[data-role=panel]").panel().enhanceWithin();
	
/*	$('.x').live('change', function() {
        $( "#comments" ).enhanceWithin().popup();  
    });*/
});