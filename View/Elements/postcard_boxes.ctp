 <style type="text/css">
 .square{
	border:3px dotted #766a62;
	padding:10px;
	margin: 7%;
	border-radius: 7px;
 }
 
 .squareimg{
	width:100%;
 }
 
 .locked{
	opacity: .1;
 }
 
 .postcardpop{
	max-width:73%;
	margin: auto;
 }
 
 .postcardpopimg{
	width:100%;
	padding: 15px 0 0 0;
 }
 
 </style>
<div class="square"  style="border-color:<?=$colors[$museum]?>">
<?
if ($percents[$museum] >= $threshold):
	$img=$museum.'_postcard.jpg';
	$url='#'.$museum.'popup';
	$class='squareimg';
	?>
	<div id="<?=$museum?>popup" data-theme="a" data-overlay-theme="a" data-role="popup">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<div class="postcardpop">
	<?=$this->Html->image($img,array('alt'=>'Cool postcard!','class'=>'postcardpopimg'));?>
	<h3>I am not even sure I like using popups here. Then again I am thinking</h3>
	</div>
	</div>
	<?
else :
	$img='lock.png';
	$url='#findmorepopup';
	$class='squareimg locked';
	?>
	<div id="findmorepopup" data-theme="a" data-overlay-theme="a" data-role="popup">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<h3>Visit some more!</h3>
	</div>
	<?
endif;
echo $this->Html->link($this->Html->image($img,array('class'=>$class)),$url,
	array(
	'escape' => false,
	'data-rel'=>'popup',
	'data-transition'=>'pop',
	'data-position-to'=>'window'));
?>
</div><!-- square -->