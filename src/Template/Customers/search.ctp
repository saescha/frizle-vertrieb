<?php $this->assign('title','Märkte'); ?>
<?= $this->Form->create(); ?>

<div>


<input type="hidden" name="customer_id" id="search-hidden">
<input type="text" id="search" placeholder="Markt auswählen" class="livesearch" data-list=".customer_list" autocomplete="off" >

<ul class="vertical customer_list" id="searchList" style="list-style-type: none;position: absolute;background: rgba(230, 240, 254, 1); z-index:1000;">
<?php
foreach( $customers as $cust ){
	echo '<li value="'.$cust->id . '">'.$cust->name.', '.$cust->city.', '.$cust->street.'</li>';
}
?>
</ul>
	<script>
$('#search').keyup(function(elem){
	$('#searchList').show();
	$('#search-hidden').val('');
});
$('#search').hideseek({
  highlight: true,
  hidden_mode: true
});

console.log($('#searchList li'))
$('#searchList li').click(function(elem) {
	$('#search').val($(this).text());
	$('#search-hidden').val($(this).val());
	$('#searchList').hide();
});

</script>



</div>


<?= $this->Form->button(__('Anzeigen')); ?>
<?= $this->Form->end() ?>