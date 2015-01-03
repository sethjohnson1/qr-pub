<? 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');
echo $this->Form->create('Feedback',array(
'data-ajax'=>'false')
);

 ?>
		<div class="ui-body ui-body-a ui-corner-all ui-shadow">
			<h3>Provide Feedback</h3>
			<p>You can use this form to send feedback regarding this application or anything about your visit to the Buffalo Bill Center of the West. We'd
			love to hear from you!</p>
<? 
//probably need some Anti-Spam thing here eventually
			echo $this->Form->input('email',array(
				'type'=>'email','required'=>'required','placeholder'=>'Your e-mail',
				'data-theme'=>'a','label'=>false

			));	
			echo $this->Form->input('message',array(
				'type'=>'textarea','placeholder'=>'Your message','required'=>'required',
				'data-theme'=>'a','label'=>false

			));				
			echo $this->Form->input('Submit',array(
				'type'=>'submit','id'=>'code_button',
				'class'=>'ui-btn ui-btn-icon-left ui-icon-check code_button','label'=>false
			
			));
?>
		</div>

	<? 
	echo $this->Form->end();



echo $this->element('jqm_basic_footer');
?>