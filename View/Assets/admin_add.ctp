<div class="assets form">
<?php 

	echo $this->Form->create('Asset',array('enctype'=>'multipart/form-data'));
	if ($type=='splash'){
		$asset_text='';
		echo $this->Form->input('file', array('type' => 'file','label'=>'Upload jpg image, 1000px wide or less works best'));
		if (isset($template['Asset'][0]['asset_text'])) $asset_text=$template['Asset'][0]['asset_text'];
		echo $this->Form->input('Attribute.asset_text',array('value'=>$asset_text,'type'=>'textarea'));
	}
	else if ($type=='vgal'){
		echo $this->Form->input('vgalid',array('label'=>'VgalID'));
		echo $this->Form->input('Get info',array('type'=>'button','id'=>'vgalbutton'));
		echo $this->Form->input('vgaljson',array('label'=>'Result','readonly' => 'readonly','id'=>'vgaljson','type'=>'textarea'));			
	}
	else if ($type=='blog'){
		echo $this->Form->input('blogid',array('label'=>'BlogID'));
		echo $this->Form->input('Get info',array('type'=>'button','id'=>'blogbutton'));
		echo $this->Form->input('blogjson',array('label'=>'Result','readonly' => 'readonly','id'=>'blogjson','type'=>'textarea','accept-charset'=>'UTF-8'));
	}
	else if ($type=='video'){
		echo $this->Form->input('youtubeid',array('label'=>'YouTubeID'));
		$asset_text='';
		if (isset($template['Asset'][0]['asset_text'])) $asset_text=$template['Asset'][0]['asset_text'];
		echo $this->Form->input('Attribute.asset_text',array('value'=>$asset_text));
		
	}
	else if ($type=='ag'){
		echo $this->Form->input('name'); 
		echo $this->Form->input('daterange'); 
		echo $this->Form->input('synopsis'); 
		echo $this->Form->input('filename',array('label'=>'YouTubeID')); 
	}
	else {
		echo ' Template type not found. Something has gone wrong. Go back to the beginning or ask for help if you keep getting here.';	
	}
	
	echo $this->Form->input('template_id',array('value'=>$id,'type'=>'hidden'));
	echo $this->Form->submit('Submit',array('class'=>'assetSubmit'));
	echo $this->Form->end(); 
	//debug($template);

		?>
</div>
<div class="actions">
	<?=$this->element('admin_actions')?>
</div>

<?php
	
	$data = $this->Js->get('#AssetAdminAddForm')->serializeForm(array('isForm' => true, 'inline' => true));
    //on button click send request to controller and displays response data in chosen field

	$this->Js->get('#vgalbutton')->event(
            'click', $this->Js->request(
                array('controller' => 'assets', 'action' => 'ajaxvgal','admin'=>true), array(
					'update' => '#vgaljson',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
                )
            )
    );
	
	$this->Js->get('#blogbutton')->event(
            'click', $this->Js->request(
                array('controller' => 'assets', 'action' => 'ajaxblog','admin'=>true), array(
					'update' => '#blogjson',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
                )
            )
    );
    
	echo $this->Js->writeBuffer();
	?>
<script type="text/javascript">
$(document).on('click', '.assetSubmit',function(e) {
	console.log('clicked');
});
</script>