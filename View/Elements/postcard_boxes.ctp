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
	<h3>From: <?=$crypt['name']?></h3>
	<p><?=$crypt['message']?></p>
	<?
	//debug($shorturl);
	if (isset($user['provider'])){
		if ($user['provider']=='Google'){
			echo $this->Html->link('Google+','https://plus.google.com/share?url='.$shorturl, array(
				'data-role'=>'button',
				'data-theme'=>'c',
				'data-icon'=>'iscout-whitegoogleplusicon',
				'target'=>'_blank'
			));
		}
	}
	?>
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