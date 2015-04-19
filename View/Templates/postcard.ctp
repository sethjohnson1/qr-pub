
<? 
echo $this->element('jqm_header');
echo $this->Form->create('Feedback',array(
'data-ajax'=>'false')
);
//fix up the totals, this could be on the Component someday
$percents=array();
//calculate percentages as normal if no $crypt or if the cookie matches (means it belongs to this user)
if ($crypt==$postcard_crypt || !isset($crypt)){
	foreach ($totals['counts'] as $key=>$val){
		$percents[$key]=$val/$totals['totals'][$key];
	}
	//everyone gets NW card!
	$percents['NW']=1;
}
else {
	$percents=json_decode($cryptdata['percents'],true);
	//debug($percs);
}


//how much you need to unlock
$threshold=.8;
$this->set(compact('percents','threshold'));
 ?>
<style>
.permalink{
	font-size:10pt !important;
}
</style> 
<div class="ui-body ui-body-a ui-corner-all ui-shadow">
	<?
	if (!isset($crypt)):
	?>
	<p>Good scouts report their findings  . . . And you can too with these handy Electronic Postcards you've earned.
		Visit or browse stops in each of our museums to earn them all.
	</p>
	<?
	//just using HTML5 validation since this never actually goes to the DB
		echo $this->Form->create('Template');
        echo $this->Form->input('name', array('div' => false,'empty'=>true,'placeholder'=>'Subject / Title','label'=>false,'maxlength'=>'43'));
        echo $this->Form->input('message', array('div' => false,'empty'=>true,'placeholder'=>'Your short message','label'=>false,'maxlength'=>'236'));
        echo $this->Form->input('percents', array('type'=>'hidden','value'=>json_encode($percents)));
        echo $this->Form->submit(__('Tattoo Message', true), array('div' => false));
        echo $this->Form->end();
	else :
	?>
<style>
.ui-input-text{
	width:150px !important;
}
</style>
	<h1><?=$cryptdata['name']?></h1>
	<h3><em><?=$cryptdata['message']?></em></h3>
	<p class="ui-mini"><strong>Permalink:</strong></label>
	<input data-enhance="false" class="permalink" type="text" value="<?=$shorturl?>" onclick="this.select();" readonly="readonly" />
	</p>
	<p class="ui-mini">
	<?='['.$this->Html->link('Start Over',array('action'=>'postcard','clear'),
	array('rel'=>'external')).'] (Permalink will remain valid)'?>
	</p>
	<?endif?>
	<div class="ui-grid-b">
		<div class="ui-block-a">
			<?=$this->element('postcard_boxes',array('museum'=>'BBM'))?>
		</div>
		<div class="ui-block-b">
			<?=$this->element('postcard_boxes',array('museum'=>'CFM'))?>
		</div>
		<div class="ui-block-c">
			<?=$this->element('postcard_boxes',array('museum'=>'DMNH'))?>
		</div>
		<div class="ui-block-a">
			<?=$this->element('postcard_boxes',array('museum'=>'WG'))?>
		</div>
		<div class="ui-block-b">
			<?=$this->element('postcard_boxes',array('museum'=>'PIM'))?>
		</div>
		<div class="ui-block-c">
			<?=$this->element('postcard_boxes',array('museum'=>'HMRL'))?>
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