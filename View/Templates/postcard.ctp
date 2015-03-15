<? 
echo $this->element('jqm_header');
echo $this->Form->create('Feedback',array(
'data-ajax'=>'false')
);
//fix up the totals, this could be on the Component someday
$percents=array();
foreach ($totals['counts'] as $key=>$val){
	$percents[$key]=$val/$totals['totals'][$key];
}
 ?>
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
 
 </style>
<div class="ui-body ui-body-a ui-corner-all ui-shadow">
			<p>A good scout reports  . . . Especially with these handy Electronic Postcards you've earned.
				Visit stops at each museum to earn them all!
			</p>
	<div class="ui-grid-a">
		<div class="ui-block-a">
			<div class="square">
			<?=$this->Html->image('itest.jpg',array('class'=>'squareimg','url'=>'#'))?>
			</div>
		</div>
		<div class="ui-block-b">
			<div class="square"  style="border-color:<?=$bbm?>">
			<?
				
				if ($percents['BBM'] >= .8){
					$img='itest.jpg';
					$url='#bbmPop';
					$class='squareimg';
					?>
<div id="bbmPop" data-theme="a" data-overlay-theme="a" data-role="popup">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
<h3>yer postcard</h3>
</div>
					<?
				}
				else {
					$img='lock.png';
					$url='#';
					$class='squareimg locked';
				}
				echo $this->Html->link($this->Html->image($img,array('class'=>$class)),$url,
					array(
					'escape' => false,
					'data-rel'=>'popup',
					'data-transition'=>'pop',
					'data-position-to'=>'window'));
				
			?>
			</div>
		</div>
		<div class="ui-block-a">
		<div class="square">
			<?=$this->Html->image('itest.jpg',array('class'=>'squareimg'))?>
		</div>
		</div>
		<div class="ui-block-b">
			<div class="square">
			<?=$this->Html->image('itest.jpg',array('class'=>'squareimg'))?>
			</div>
		</div>
		<div class="ui-block-a">
			<div class="square">
			<?=$this->Html->image('itest.jpg',array('class'=>'squareimg'))?>
			</div>
		</div>
		<div class="ui-block-b">
			<div class="square">
			<?=$this->Html->image('itest.jpg',array('class'=>'squareimg'))?>
			</div>
		</div>
	</div><!-- /ui-grid -->
</div><!-- ui-body -->
	<? 
	echo $this->Form->end();



echo $this->element('jqm_basic_footer');
?>