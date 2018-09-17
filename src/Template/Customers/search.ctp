<?php $this->assign('title', 'Märkte'); ?>


<script>


var customers =  <?= json_encode($customers, JSON_UNESCAPED_UNICODE)  ?>;
var indexedCustomers = [];
var idx = lunr(function () {
//   this.ref('id');
  this.field('name');
  this.field('city');
  this.field('street');
  customers.forEach(function (cust) {
    indexedCustomers[cust.id] = cust;
    this.add(cust);
  }, this);
})




function mysearch(string){
    if(string.length < 3)return;
    var results = idx.search(string);
    $('#resultTable').empty();
    results.forEach( (r) =>{
        var row = $('<tr>');
        row.append('<td>'+indexedCustomers[r.ref].name +'</td>');
        row.append('<td>'+indexedCustomers[r.ref].city +'</td>');
        row.append('<td>'+indexedCustomers[r.ref].plz +'</td>');
        row.append('<td>'+indexedCustomers[r.ref].street +'</td>');
        row.append('<td><a href="/customers/view/'+r.ref+'">Anzeigen</a></td>');
        $("#resultTable").append(row);
    });

    return;

}
</script>


<div class="customers index large-9 medium-8 columns content">
    <h3><?= __('Märkte') ?></h3>
    <div>

<input type="text" id="search" placeholder="Markt auswählen" onkeyup="mysearch(this.value);" >


</div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>

                <th>Name</th>
                <th>Stadt</th>
                <th>PLZ</th>
                <th>Straße</th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody id="resultTable">
        </tbody>
	</table>


</div>

