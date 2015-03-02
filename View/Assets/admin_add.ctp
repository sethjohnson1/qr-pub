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
		echo '<h3>Please be careful, once submitted you cannot edit (but rather have to re-enter everything)</h3>';
		echo $this->Form->input('name',array('label'=>'Title'));  
		echo $this->Form->input('commonname',array('label'=>'Maker','type'=>'text')); 
		echo $this->Form->input('daterange',array('type'=>'text')); 
		echo $this->Form->input('asset_text',array('label'=>'Medium','type'=>'text'));
		echo $this->Form->input('dimensions',array('type'=>'text'));
		echo $this->Form->input('creditline',array('type'=>'text'));
		echo $this->Form->input('synopsis',array('label'=>'Transcript')); 
		echo $this->Form->input('filename',array('label'=>'YouTubeID')); 
		echo $this->Form->input('inscription',array('type'=>'text','value'=>'Audio courtesy of Acoustiguide'));
	}
	else if ($type=='tn'){
		echo $this->Form->input('xml',array('label'=>'Paste XML here','type'=>'textarea','accept-charset'=>'UTF-8'));	
	}
	else {
		echo ' Template type not found. Something has gone wrong. Go back to the beginning or ask for help if you keep getting here.';	
	}	
	echo $this->Form->input('template_id',array('value'=>$id,'type'=>'hidden'));
	echo $this->Form->submit('Submit',array('class'=>'assetSubmit'));
	echo $this->Form->end(); 
		?>
	<h2 class="statusMessage" >
	
	</h2>
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
$('input:submit').click(function(){
	$('h2.statusMessage').text("Submitting the magic. Please wait...");
	$('input:submit').attr("style","display: none;" );	
});

/*
$('.assetSubmit').toggle(function(){
    $(this).text('Pending Request');
}, function(){
    $(this).text('Invite');
});
*/
</script>