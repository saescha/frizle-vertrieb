<?= $this->Form->create(); ?>

<div>

<?php if($pcustomer_id){ ?>
<input type="hidden" name="customer_id" id="search-hidden" value="<?= $pcustomer_id ?>">

<?php }else{ ?>
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
<?= $this->Html->link(__('Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']); ?>
<?php } ?>


</div>
<?php 

foreach( $questions as $q ){
	echo '<div>';
	echo $q->text;
	echo '</div>';
	echo  '<fieldset>';
	if ( $q->type == 'C'){
	
	foreach( $q->choices as $c){
	echo '<label>';
	echo $this->Form->checkbox('C'. $c->id, [
    'value' => $c->id
	]);
	echo $c->text;
	echo '</label>';
	}
}
elseif($q->type == 'R'){
	$radio = array();
	foreach( $q->choices as $c){
		array_push( $radio, [ 'value' => $c->id , 'text' => $c->text ] );
	}
	echo $this->Form->radio( $q->id , $radio );
	
}elseif($q->type == 'F'){
	echo $this->Form->input( $q->id, [ 'id' => $q->id , 'label' => '' ] );
}
echo '</fieldset>';

	
}

 ?>
<?= $this->Form->button(__('Senden')); ?>
<?= $this->Form->end() ?>