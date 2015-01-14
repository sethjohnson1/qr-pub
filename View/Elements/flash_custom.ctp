<?
// this is for the Session flash messages, I have modified UsersPlugin and Templates Controller to use it
?>
<div id="sessionFlash" class="ui-shadow ui-body ui-body-a ui-corner-all">
<style scoped>
div#sessionFlash {
	padding: 5px 10px;
	margin: 4px 1px;
}
</style>
<? echo $message; ?>
</div>