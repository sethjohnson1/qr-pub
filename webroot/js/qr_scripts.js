$( document ).on( "pageinit", function( event ) {
	$( "#CodePopUp" ).enhanceWithin().popup();
	$( "#Scorecard" ).enhanceWithin().popup();  
	$( "#userPopup" ).enhanceWithin().popup();  
	$( "#menu" ).enhanceWithin().panel();  
	//$( "#Scorecard" ).popup( "open" );
	//$("[data-role=panel]").panel().enhanceWithin();
	
/*	$('.x').live('change', function() {
        $( "#comments" ).enhanceWithin().popup();  
    });*/
	//$("#comment_add").bind("click", function (event) {});
});


//hacky way to get anchor tags to work sometimes (can probably be removed unless we need it)
//http://dev4theweb.blogspot.com/2012/07/anchor-links-and-jquery-mobile.html
$(document).ready(function () {

});
