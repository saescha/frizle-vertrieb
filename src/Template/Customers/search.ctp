<?php $this->assign('title','Märkte'); ?>


<script>


var customers =  <?= json_encode($customers,JSON_UNESCAPED_UNICODE)  ?>;
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
    var results = myfilter(string);
    $('#resultTable').empty();
    results.forEach( (r) =>{
        var row = $('<tr>');
        row.append('<td>'+r.name +'</td>');
        row.append('<td>'+r.city +'</td>');
        row.append('<td>'+r.plz +'</td>');
        row.append('<td>'+r.street +'</td>');
        row.append('<td><a href="/customers/view/'+r.id+'">Anzeigen</a></td>');
        $("#resultTable").append(row);
    });

    return;

}
</script>
<div>

<input type="text" id="search" placeholder="Markt auswählen" onkeyup="mysearch(this.value);" >


</div>

<div class="customers index large-9 medium-8 columns content">
    <h3><?= __('Märkte') ?></h3>
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

