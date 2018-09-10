<?php $this->assign('title','Märkte'); ?>
<?= $this->Form->create(); ?>


<script>
var options = {
  keys: ['name','city','plz','street'],
  id: 'id'
}

var customers = <?= json_encode($customers ) ?>;
var fuse = new Fuse(customers,options)

function search(string){
	var results = fuse.search(string);
	#('#resultTable').innerHTML = "";
	results.foreach( (r) =>{
		var row = #('<tr>');

		row.append('<td>'+r.name +'</td>');
		row.append('<td>'+r.city +'</td>');
		row.append('<td>'+r.plz +'</td>');
		row.append('<td>'+r.street +'</td>');
	})

}
</script>
<div>

<input type="text" id="search" placeholder="Markt auswählen" onchange="search(this.value)" >


</div>

<div class="customers index large-9 medium-8 columns content">
    <h3><?= __('Märkte') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('name','Name') ?></th>
                <th><?= $this->Paginator->sort('city','Stadt') ?></th>
                <th><?= $this->Paginator->sort('plz','Postleitzahl') ?></th>
                <th><?= $this->Paginator->sort('street','Straße') ?></th>
   <!--         <th><?= $this->Paginator->sort('category_id','Kategorie') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('created','erstellt') ?></th>
                <th><?= $this->Paginator->sort('modified','geändert') ?></th>  -->
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody id="resultTable">
	</table>
</div>


<?= $this->Form->button(__('Anzeigen')); ?>
<?= $this->Form->end() ?>