

<?php 
usort( $questions , function($a, $b)
{
    if ($a->sequence_number == $b->sequence_number)
    {
        return 0;
    }
    else if ($a->sequence_number > $b->sequence_number)
    {
        return 1;
    }
    else {             
        return -1;
    }
});

usort( $customers , function($a, $b)
{
    if ($a->city == $b->city)
    {
        return 0;
    }
    else if ($a->city > $b->city)
    {
        return 1;
    }
    else {             
        return -1;
    }
});

echo $this->Form->create();
echo '<div>Markt auswählen</div>';
$city = '';

echo '<div>';
echo '<select name="customer_id" size="5" >';

foreach( $customers as $cust ){
if ( $city != $cust->city ){
	echo  '<optgroup label="'.$cust->city.'">';
}
echo '<option value="'. $cust->id .'">' . $cust->name .', ' . $cust->street . '</option>';
$city = $cust->city;
}
echo '</select>';
echo $this->Html->link(__('Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']);
echo '</div>';



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