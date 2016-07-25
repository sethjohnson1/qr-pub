<style type="text/css" scoped>

#interact{
	display:none;
}
.slide{
	padding:10px;
}
.animals{
	margin: 0 auto; 
}
.animals>ul{
	font-size:1em;
	list-style-type: none;

}

.infodiv{
	display:none;
	border:1px solid #766a62;
	background-color: #ebe1dd;
	margin:85px 41px 41px 41px;
	padding:10px;
	border-radius: 3px;
	-webkit-box-shadow: 5px 4px 6px 0px #999;
	-moz-box-shadow: 5px 4px 6px 0px #999;
	box-shadow: 5px 4px 6px 0px #999;
	color: black;
	float: left;
	width:410px;
}
#myContainer { 
	border:1px solid #696969;
	/* looks nice on desktop
	width:760px; 
	height:760px; 
	*/
	/*for nabi */
	width:510px; 
	height:510px; 
	float: left;
	display:inline;
	margin:auto;
} 

.animal_buttons>tbody>tr>td, .explore {
  background: #981e32;
  background-image: -webkit-linear-gradient(top, #981e32, #701424);
  background-image: -moz-linear-gradient(top, #981e32, #701424);
  background-image: -ms-linear-gradient(top, #981e32, #701424);
  background-image: -o-linear-gradient(top, #981e32, #701424);
  background-image: linear-gradient(to bottom, #981e32, #701424);
  -webkit-border-radius: 5;
  -moz-border-radius: 5;
  border-radius: 5px;
  -webkit-box-shadow: 0px 1px 3px #666666;
  -moz-box-shadow: 0px 1px 3px #666666;
  box-shadow: 0px 1px 3px #666666;
  font-size: 1em;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
  color:white;
  -webkit-text-shadow: none;
	-moz-text-shadow: none;
	text-shadow: none;
	font-weight:bold;
	text-align:center;
}
.animal_buttons{
	width:100%;
	border-spacing: 5px;
}
.animal_buttons>tbody>tr>td:hover, .explore:hover{
  background: #701424;
  background-image: -webkit-linear-gradient(top, #701424, #5e101e);
  background-image: -moz-linear-gradient(top, #701424, #5e101e);
  background-image: -ms-linear-gradient(top, #701424, #5e101e);
  background-image: -o-linear-gradient(top, #701424, #5e101e);
  background-image: linear-gradient(to bottom, #701424, #5e101e);
  text-decoration: none;
  cursor: pointer;
  color: #bd4f19;
}

.explore{
	color:#ffffff !important;
	margin: 0 auto;
    display: block;
    width: 86%;
}

.fullview{
	position: absolute;
	top:461px;
	right:415px;
}

</style>

<?=$this->Html->script('ZoomifyImageViewerPro-v4-min.js')?>
<script type="text/javascript"> Z.showImage("myContainer", "https://centerofthewest.org/zoomify_treasures/james_prosek_yellowstone_composition_no_1", "zImageProperties=<IMAGE_PROPERTIES WIDTH='13480' HEIGHT='13525' NUMTILES='3804' NUMIMAGES='1' VERSION='1.8' TILESIZE='256'/>&zNavigatorVisible=0&zToolbarVisible=0&zLogoVisible=0&zSliderVisible=0&zFullPageVisible=0&zFullScreenVisible=0&zProgressVisible=0&zTooltipsVisible=0&zPanButtonsVisible=0&zDebug=0"); </script>
</head>
<body>
<div id="intro" class="slide">
<h1>Yellowstone Composition No. 1</h1>
<h3><em>By James Prosek</em></h3>
<p>Yellowstone's reach extends farther than most of us realize. Populations of elk migrate from within the Park to outlying areas and back again each year, sometimes traveling more than a hundred miles to access food and to reproduce. However, the journeys of elk might be considered fairly "local" when compared to some other Yellowstone species' migrations of hundreds or even thousands of miles. </p>

<p>In <em>Yellowstone Composition No. 1</em>, artist James Prosek highlights twelve of Yellowstone's long-distance migrants in brilliant color and exquisite detail. By scattering the twelve vibrant creatures amongst almost seven hundred others depicted in silhouette, Prosek suggests that not only are these migrant species interconnected with Yellowstone's resident populations, but also that Yellowstone's wildlife is dependent upon a much larger geographical area beyond the Park's boundaries.
</p>

<p style="font-style:italic; padding:0 40px 0 40px;">"The idea of an ecosystem itself is flawed. The existence of the word suggests that an ecosystem has a beginning and an end; the word puts up walls... We have yet to truly and finally embrace... a holistic, interconnected planet."</p>
<p style="padding-left:115px; margin-top:-12px;">- James Prosek
</p>
<hr style="clear:both">
<h1><a href="#painting" class="toggle explore">Explore the Painting</a></h1>
</div>
<div id="interact" class="slide">
<a name="painting"></a>
<div id="myContainer"></div>

<div id="craneinfo" class="infodiv">
<p>Sandhill Cranes, the most common of the world's cranes, are generally found in North America, but range as far south as Mexico and Cuba and as far west as Siberia. Some Sandhill Cranes call Yellowstone home in the summer and spend the winter in the Rio Grande Valley of New Mexico and Mexico.
</p>
</div>
<div id="antelopeinfo" class="infodiv">
<p>
Pronghorn can range from southern Canada to northern Mexico throughout the year. Some of the pronghorn that summer in the Greater Yellowstone Ecosystem have incredibly long migrations, the longest of any land mammal in the conterminous United States. Some groups travel up to 200 miles each spring and fall. As a result of the work of wildlife biologists and other stakeholders, several critical wildlife corridors have been created or enhanced to facilitate antelope migration.
</p>
</div>
<div id="blackbirdinfo" class="infodiv">
<p>
Red-winged Blackbirds are some of the most widely-distributed birds in North America. Their breeding grounds range from coast to coast in northern North America and they generally winter in central and southern North America, and in Central America. In the Greater Yellowstone Ecosystem, the Red-winged Blackbird usually nests mid-May to early June before they head south in late summer.
</p>
</div>
<div id="tanagerinfo" class="infodiv">
<p>
Western Tanagers breed in woodlands throughout much of western North America from the Yukon south to New Mexico and Arizona. They are common breeders in Greater Yellowstone, but migrate as far south as Panama in winter, more than three thousand miles from Yellowstone National Park. 
</p>
</div>
<div id="troutinfo" class="infodiv">
<p>
Yellowstone Cutthroat Trout are native to the Greater Yellowstone Ecosystem. Their migrations from Yellowstone Lake to regional tributaries to spawn each spring are vital to the Park's ecosystem; they factor significantly into diets of Grizzly Bears, Osprey, and Bald Eagles. In the past, diminished populations of Yellowstone Cutthroat Trout have led Grizzly Bears to turn to alternate food sources, like migratory elk, for sustenance.
</p>
</div>

<div id="curlewinfo" class="infodiv">
<p>
Long-billed Curlews breed in the grasslands of the Great Plains and intermountain basins, including portions of the Greater Yellowstone Ecosystem. They migrate most often along Pacific coastal mudflats and winter as far south as Mexico and the southern United States. On average, the Long-billed Curlew migrates more than 1,550 miles annually.
</p>
</div>

<div id="hummingbirdinfo" class="infodiv">
<p>
Calliope Hummingbird are the smallest long-distance avian migrants in the world. Generally, they summer in the high elevations of the northern Rockies and winter in the mountains of Mexico. Some Calliope Hummingbirds travel up to 5,600 miles annually.
</p>
</div>

<div id="butterflyinfo" class="infodiv">
<p>
Monarch Butterflies, the only butterfly known to make two-way migrations like birds, fly up to 3,000 miles to reach their winter range. Most Monarch Butterflies live east of the Rocky Mountains, including in Greater Yellowstone. These butterflies can be found as far north as Canada and, in winter, as far south as southern California and Mexico.
</p>
</div>

<div id="pelicaninfo" class="infodiv">
<p>
American White Pelicans are long-distance migrants that breed throughout the northern United States and Canada. In winter, these birds often migrate south to the Pacific Coast of the Americas, ranging from California to Nicaragua, as well as to the Gulf Coast and, occasionally, the Caribbean Islands.
</p>
</div>

<div id="hawkinfo" class="infodiv">
<p>
Swainson's Hawks breed mostly on the farms, sagebrush flats, and grasslands of western North America where they feed primarily on small mammals and insects. On migration, they pass the Isthmus of Panama, through a narrow corridor in the Andes Mountains, and winter as far south as the Pampas of southern Brazil, Uruguay, and Argentina. The Swainson's Hawk's journey can extend more than 6,200 miles beyond the boundaries of Yellowstone National Park.
</p>
</div>

<div id="owlinfo" class="infodiv">
<p>
Burrowing Owls summer in grasslands, deserts, and other open habitats in the Midwestern United States, the Pacific Northwest, and Canada. Their winter range encompasses Central America, Mexico, Florida, and parts of South America.
</p>
</div>

<div id="duckinfo" class="infodiv">
<p>
Harlequin Ducks range between America's interior, as far east as Yellowstone National Park, and the west coast. There is also a population along the east coast of Canada. Some Harlequins breed along fast-moving inland streams and rivers and then migrate to the rocky coastal inlets each winter.
</p>
</div>

<div id="generalinfo" class="infodiv">
<p>
Click the animal names to learn more.
</p>
</div>
<h3 class="fullview"><a id="general" href="#painting" onmousedown="Z.Viewport.reset()">Full View</a></h3>
<div style="clear:both"></div>
<div class="animals">
<? //zoomify4 uses decimals for zoom value ?>
<table class="animal_buttons">
<tbody>
<tr>
<td id="crane" onmousedown="Z.Viewport.zoomAndPanToView(862,1564,.365);">Sandhill Crane</td>
<td id="antelope" onmousedown="Z.Viewport.zoomAndPanToView(7400,2456,.30);">Pronghorn</td>
<td id="blackbird" onmousedown="Z.Viewport.zoomAndPanToView(12162,2953,100);">Red-winged Blackbird</td>
<td id="tanager" onmousedown="Z.Viewport.zoomAndPanToView(4464,4597,100);">Western Tanager</td>
</tr>
<tr>
<td id="trout" onmousedown="Z.Viewport.zoomAndPanToView(4895,6255.3,.7);">Yellowstone Cutthroat Trout</td>
<td id="curlew" onmousedown="Z.Viewport.zoomAndPanToView(9047,6456,100);">Long-billed Curlew</td>
<td id="hummingbird" onmousedown="Z.Viewport.zoomAndPanToView(846,7456,100);">Calliope Hummingbird</td>
<td id="butterfly" onmousedown="Z.Viewport.zoomAndPanToView(10126,8058,100);">Monarch Butterfly</td>
</tr>
<tr>
<td id="pelican" onmousedown="Z.Viewport.zoomAndPanToView(8257,9078,.3135);">American White Pelican</td>
<td id="hawk" onmousedown="Z.Viewport.zoomAndPanToView(2014,12522,.81);">Swainson's Hawk</td>
<td id="owl" onmousedown="Z.Viewport.zoomAndPanToView(5728,11173,100);">Burrowing Owl</td>
<td id="duck" onmousedown="Z.Viewport.zoomAndPanToView(10716,11545,.81);">Harlequin Duck</td>
</tr>
</tbody>
</table>
</div>
<p>Photography: Tim Nighswander/IMAGING4ART</p>
<h1><a href="" class="toggle explore">Go Back</a></h1>
</div>

<script type="text/javascript">
$(function() 
{
$("#generalinfo").fadeIn();	
$(".toggle").click(function(){
   $(".slide").slideToggle();
});
$("#crane").click(function(){
   $(".infodiv").hide();
   $("#craneinfo").fadeIn();
});
$("#antelope").click(function(){
    $(".infodiv").hide();
    $("#antelopeinfo").fadeIn();
});
$("#blackbird").click(function(){
    $(".infodiv").hide();
    $("#blackbirdinfo").fadeIn();
});
$("#tanager").click(function(){
    $(".infodiv").hide();
    $("#tanagerinfo").fadeIn();
});
$("#trout").click(function(){
    $(".infodiv").hide();
    $("#troutinfo").fadeIn();
});
$("#curlew").click(function(){
    $(".infodiv").hide();
    $("#curlewinfo").fadeIn();
});
$("#hummingbird").click(function(){
    $(".infodiv").hide();
    $("#hummingbirdinfo").fadeIn();
});
$("#butterfly").click(function(){
    $(".infodiv").hide();
    $("#butterflyinfo").fadeIn();
});
$("#pelican").click(function(){
    $(".infodiv").hide();
    $("#pelicaninfo").fadeIn();
});
$("#hawk").click(function(){
    $(".infodiv").hide();
    $("#hawkinfo").fadeIn();
});
$("#owl").click(function(){
    $(".infodiv").hide();
    $("#owlinfo").fadeIn();
});
$("#duck").click(function(){
    $(".infodiv").hide();
    $("#duckinfo").fadeIn();
});
$("#general").click(function(){
    $(".infodiv").hide();
    $("#generalinfo").fadeIn();
});
})
</script>
</body>