<div data-role="popup" id="img<? //'.$template['Template']['id'].'?>" data-theme="a">
<div role="main" class="ui-content">
<? 
//echo $this->element('jqm_header');

echo '<h1>popup</h1>';

?>
</div>
  <script>
    $("[data-role=popup]").enhanceWithin().popup({
        afterclose: function () {
            $(this).remove();
        }
    }).popup("open");
  </script>
</div>