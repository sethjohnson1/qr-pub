
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
//everyone gets the "Nowhere" card!
$percents['NW']=1;

//how much you need to unlock
$threshold=.8;
$this->set(compact('percents','threshold'));
 ?>
<div class="ui-body ui-body-a ui-corner-all ui-shadow">
	<?
	//debug($prgdata);
	if (!isset($crypt)):
	?>
	<p>Good scouts reports their findings  . . . Especially with these handy Electronic Postcards you've earned.
		Visit or browse stops at each museum to earn them all.
	</p>
	<?
		echo $this->Form->create('Template');
        echo $this->Form->input('name', array('div' => false,'empty'=>true,'placeholder'=>'Subject / Title','label'=>false));
        echo $this->Form->input('message', array('div' => false,'empty'=>true,'placeholder'=>'Your short message','label'=>false));
        echo $this->Form->input('percents', array('type'=>'hidden','value'=>json_encode($percents)));
        echo $this->Form->submit(__('Make Tattoo', true), array('div' => false));
        echo $this->Form->end();
	
	else :
	?>
	<h1><?=$crypt['name']?></h1>
	<h3><em><?=$crypt['message']?></em></h3>
	<? echo '['.$this->Html->link('Clear',array('action'=>'postcard','clear'),
	array('rel'=>'external')).']';
	endif;
	?>
	<div class="ui-grid-b">
		<div class="ui-block-a">
			<?=$this->element('postcard_boxes',array('museum'=>'NW'))?>
		</div>
		<div class="ui-block-b">
			<?=$this->element('postcard_boxes',array('museum'=>'BBM'))?>
		</div>
		<div class="ui-block-c">
			<?=$this->element('postcard_boxes',array('museum'=>'CFM'))?>
		</div>
		<div class="ui-block-a">
			<?=$this->element('postcard_boxes',array('museum'=>'DMNH'))?>
		</div>
		<div class="ui-block-b">
			<?=$this->element('postcard_boxes',array('museum'=>'WG'))?>
		</div>
		<div class="ui-block-c">
			<?=$this->element('postcard_boxes',array('museum'=>'PIM'))?>
		</div>
		<div class="ui-block-a">
			<?=$this->element('postcard_boxes',array('museum'=>'HMRL'))?>
		</div>
		<div class="ui-block-b">
			<?=$this->element('postcard_boxes',array('museum'=>'Garden'))?>
		</div>
		<div class="ui-block-c">
			<?=$this->element('postcard_boxes',array('museum'=>'NW'))?>
		</div>
		
	</div><!-- /ui-grid -->
</div><!-- ui-body -->
<? if (isset($crypt)):?>
<p><strong>Please note: </strong> Some content on this page may have been
dynamically generated using that crazy-long URL.
<?='To reset the original view, '.$this->Html->link('click this magic link.',array('action'=>'postcard','clear'),
	array('rel'=>'external')
)?>
</p>
<?endif?>
<?=$this->element('jqm_basic_footer')?>