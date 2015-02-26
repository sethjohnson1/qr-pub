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
	else if ($type=='tn'){
		if (!isset($this->request->query['num'])) echo $this->Form->input('num',array('label'=>'How many?'));
		else {
			echo '<h3>Please keep this text in some other safe place as this software currently 
				does not support returning to edit.</h3>';
			for ($x=1;$x<=$this->request->query['num'];$x++){ 
				echo '<div style="border:1px solid green; padding: 5px;"><p>#'.$x.'</p>';
				echo $this->Form->input('sortorder'.$x,array('value'=>$x,'type'=>'hidden')); 
				echo $this->Form->input('file'.$x, array('type' => 'file','label'=>'Upload jpg image, 150px square is plenty big'));
				echo $this->Form->input('synopsis'.$x,array('label'=>'Deep thoughts','type'=>'textarea')); 
				echo '</div>';
				//echo $this->Form->input('synopsis');
			}
		}		
	}
	else {
		echo ' Template type not found. Something has gone wrong. Go back to the beginning or ask for help if you keep getting here.';	
	}
	
	echo $this->Form->input('template_id',array('value'=>$id,'type'=>'hidden'));
	echo $this->Form->submit('Submit',array('class'=>'assetSubmit'));
	echo $this->Form->end(); 
	//debug($template);

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