<div id="CodePopUp" data-theme="a">
<? echo $this->Form->create('Code',array(
'data-ajax'=>'false',
'id'=>'CodeForm',
'url'=>array('action'=>'code_button','controller'=>'templates','plugin'=>'')
));

 ?>
		<div style="padding:10px 20px;">
			<h3>Enter Code</h3>
			<label for="un" class="ui-hidden-accessible">Code:</label>
<? 
			echo $this->Form->input('3digitcode',array(
				'id'=>'code','type'=>'text','placeholder'=>'3-digit Code',
				'data-theme'=>'a','label'=>false

			));		
			echo $this->Form->input('Go',array(
				'type'=>'submit','id'=>'code_button',
				'class'=>'ui-btn ui-btn-icon-left ui-icon-check','label'=>false
			
			));
?>
		</div>

	<? 
	echo $this->Form->end();
	?>
</div>