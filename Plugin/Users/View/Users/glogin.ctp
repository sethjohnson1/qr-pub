<?php
echo $this->Form->create('User');
echo $this->Form->input('provider', array('value' => 'Google','type'=>'hidden'));
if (isset($var)){

echo $this->Form->end('Confirm Registration');
}
else{

//echo $this->Form->input('openid_identifier', array('value' => 'https://www.google.com/accounts/o8/id'));
echo $this->Form->end('Go to Google to Login');
}
?>

<?php echo $this->element('Users.Users/sidebar'); ?>
