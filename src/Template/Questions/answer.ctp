





<div>

<?php if($pcustomer_id){ ?>
	<div class="customers form large-9 medium-8 columns content">
	<?= $this->Form->create(); ?>
	<input type="hidden" name="customer_id" id="search-hidden" value="<?= $pcustomer_id ?>">

<?php }else{ ?>
	<script>
 
 
 var customers =  <?= json_encode($customers, JSON_UNESCAPED_UNICODE)  ?>;
 var last = {
     string: "",
     customers: []
 }
 function myfilter(string){
     if(last.string.indexOf(string) > - 1){
         var result = last.customers;
     }else{
         var result = customers;
     }
 
     string.toLowerCase().split(" ").forEach( (s) =>{
         result = result.filter( (r) =>{
             return r.concat.indexOf(s) > -1;
         })
     })
     last.string = string;
     last.customers = result;
     if(result){
         return result;
     }
     return [];
 }
 
 function mysearch(string){
     if(string.length < 3)return;
     var results = myfilter(string);
     $('#resultTable').empty();
     results.forEach( (r) =>{
         var row = $('<tr>');

         row.append('<td><input name="customer_id" value="' + r.id + '" type="radio" >'+r.name +'</td>');
         row.append('<td>'+r.city +'</td>');
         row.append('<td>'+r.street +'</td>');
         
         $("#resultTable").append(row);
     });
 
     return;
 
 }
 </script>

	<input type="text" id="search" placeholder="Markt auswählen" onkeyup="mysearch(this.value);" >
	<div class="customers form large-9 medium-8 columns content">
	<?= $this->Html->link(__('Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']); ?>
	<?= $this->Form->create(); ?>

	<table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Stadt</th>
                <th>Straße</th>
            </tr>
        </thead>
        <tbody id="resultTable">
        </tbody>
	</table>


<?php } ?>



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
</div>