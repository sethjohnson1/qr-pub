<div id="CodePopUp" data-theme="a">
<? echo $this->Form->create('Code');

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
	
	/*	$data = $this->Js->get('#CodeViewForm')->serializeForm(array('isForm' => true, 'inline' => true));
    //on button click send request to controller and displays response data in chosen field

	$this->Js->get('#code')->event(
            'click', $this->Js->request(
                array('controller' => 'templates', 'action' => 'code_lookup'), array(
					//'update' => '#code',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
                )
            )
    );
	*/
	
	?>
</div>