<? 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');
echo $this->Form->create('Feedback',array(
'data-ajax'=>'false')
);

 ?>
		<div class="ui-body ui-body-a ui-corner-all">
			<h3>About iScout</h3>
			<p>Mention Frameworks with link to blog post, blah blah</p>
		</div>
		<br />
		<div class="ui-body ui-body-a ui-corner-all">
		<h3>Terms of Use and Privacy Policy</h3>
		<p>etc, can this be grabbed from somewhere</p>
		</div>

	<? 
	echo $this->Form->end();



echo $this->element('jqm_basic_footer');
?>