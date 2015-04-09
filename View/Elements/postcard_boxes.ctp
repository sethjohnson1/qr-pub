<?
if ($percents[$museum] >= $threshold){
	$borderstyle='double';
}
else {
	$borderstyle='dotted';
}

$borderwidth='3px';
?>
 <style type="text/css">
 .square{
	padding:10px;
	margin: 7%;
	border-radius: 7px;
 }
 
 .squareimg{
	width:100%;
 }
 
 .locked{
	opacity: .1;
	max-width:76%;
	padding-left:10%;
 }
 
 .postcardpop{
	max-width:73%;
	margin: auto;
	padding: 0 0 20px 0;
 }
 
 .postcardpopimg{
	width:100%;
	padding: 15px 0 0 0;
 }
 
 </style>
 <?
 //very intentional reasons for inline CSS here
 ?>
<div class="square"  style="border:<?=$borderwidth.' '.$borderstyle.' '.$colors[$museum]?>">
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
	<?
	if (isset($cryptdata)):
	?>
	<h3><?=$cryptdata['name']?></h3>
	<p><?=$cryptdata['message']?></p>
	<?else:?>
	<h3>Your message here!</h3>
	<p>Use the <em>Tattoo Message</em> button to create a permanent link to your custom text.<br/>
	<strong>Create and share as many as you want!</strong> You won't break our server (we think).
	</p>
	<?endif?>
	<?=$this->element('social_buttons')?>
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
	<div style="padding:40px">
	<h3 align="center">This postcard is locked!</br /> Don't let that stop you. <br />
	<?=$this->Html->link('Browse around',array('action'=>'browse'))?>
	each museum to unlock them.
	</h3>
	</div>
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