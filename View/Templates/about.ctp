<? 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');

if (Configure::read('enableKioskMode')!=1) :
$browselink=$this->Html->link('here',array('action'=>'browse'));
$feedbacklink=$this->Html->link('feedback',array('action'=>'feedback'));
 ?>
		<div class="ui-body ui-body-a ui-corner-all ui-shadow">
			<h3>About iScout</h3>
			
			<p>Buffalo Bill was a scout in his early career. You can be too with iScout!</p>
			<p>
			As you tour the Center of the West's museums, scout out each
			stop with a 3-digit code (like this? Maybe have a picture). If your not at the Center of the West at the moment,
			you can browse all of the stops <?=$browselink?>.
			</p>
			<p>
What will you find? An image? A blog post? A virtual gallery of similar objects? Explore!
			</p>
			<p>
A good scout reports their findings! Login using the icon in the upper right with Facebook, Google+, Twitter—or create a simple account. Then share what you discover on social media, make comments, up- or down-vote other scouts’ comments, and most of all, have fun!
			</p>
		
		<h3>Credits and Tech Notes</h3>
		
		<p>
		This software was made possible with almost zero budget thanks to the Center of the West staff
		and open source projects such as <a href="http://cakephp.org/">CakePHP</a> and 
		<a href="http://jquerymobile.com">jQuery mobile</a>. We are always working to improve it,
feel free to leave us some <?=$feedbacklink?>. If you're a developer or are interested in reproducing this
for your own needs, check us out on <a href="http://github.com/sethjohnson1/qr-pub/">GitHub</a>. 
		</p>
		</div>
		<br />
		<div class="ui-body ui-body-a ui-corner-all ui-shadow">
		<h3>Terms of Use and Privacy Policy</h3>
		<p>etc, can this be grabbed from somewhere</p>
		</div>
	<? 
	else: //kiosk mode
	?>
		<div class="ui-body ui-body-a ui-corner-all ui-shadow">
			<h3>Kiosk Mode</h3>
				<p> this page is not finished yet!</p>
		</div>
	<? endif;
echo $this->element('jqm_basic_footer');
?>