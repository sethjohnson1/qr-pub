	</div><!-- /content main -->
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
	<?if($this->request->action=='scorecard'  || $this->request->action=='postcard'):?>
		<div class="ui-grid-a" style="text-align:center;position: relative;top: 7px;">
		<?
		if ($this->request->action=='scorecard'){
			echo $this->Html->link('My Postcards',
				array('action'=>'postcard',$postcard_crypt),
				array(
				//does nothing
				'class'=>'buttonstyle',
				'data-role'=>'button',
				'data-icon'=>'grid',
				'data-iconpos'=>'right',
				'data-prefetch'=>true,
				'data-theme'=>'f'
				));
		}
		if ($this->request->action=='postcard'){
			echo $this->Html->link('My Score Card',
				array('action'=>'scorecard'),
				array(
				//does nothing
				'class'=>'buttonstyle',
				'data-role'=>'button',
				'data-icon'=>'bullets',
				'data-iconpos'=>'right',
				'data-prefetch'=>true,
				'data-theme'=>'f'
				));
		}
			?>
		</div><!-- /ui-grid -->
		<? endif; //scorecard IF?>
	</div><!-- /footer -->
</div><!-- /page -->