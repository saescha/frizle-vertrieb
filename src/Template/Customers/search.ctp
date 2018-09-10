<?php $this->assign('title','Märkte'); ?>



<script>
var options = {
    // tokenize: true,
    // matchAllTokens: true,
    // shouldSort: true,
    findAllMatches: true,
    includeScore: true,
  keys: ['name','city','plz','street']
}

var customers =  <?= json_encode($customers,JSON_UNESCAPED_UNICODE)  ?>;
var fuse = new Fuse(customers,options)

function mysearch(string){
	var results = fuse.search(string);
	$('#resultTable').empty();
	results.forEach( (r) =>{
		var row = $('<tr>');
		row.append('<td>'+r.item.name +'</td>');
		row.append('<td>'+r.item.city +'</td>');
		row.append('<td>'+r.item.plz +'</td>');
		row.append('<td>'+r.item.street +'</td>');
        row.append('<td>'+r.score +'</td>');
        $("#resultTable").append(row);
	});
}
</script>
<div>

<input type="text" id="search" placeholder="Markt auswählen" onkeydown="mysearch(this.value);" >


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
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody id="resultTable">
        </tbody>
	</table>


</div>

