<?php $this->assign('title','Märkte'); ?>


<script>
var options = {
    // tokenize: true,
    // matchAllTokens: true,
    // shouldSort: true,
    // findAllMatches: true,
    includeScore: true,
    includeMatches: true,
    minMatchCharLength: 3,
    
  keys: ['name','city']
}

var customers =  <?= json_encode($customers,JSON_UNESCAPED_UNICODE)  ?>;
var fuse = new Fuse(customers,options)

function mysearch(string){
	var results = fuse.search(string);
	$('#resultTable').empty();
	results.forEach( (r) =>{
		var row = $('<tr>');
        var col = $('<td>');
        col.append('<h4>'+r.item.name+'</h5>');

        
        r.matches.forEach((m)=>{
            if(m.key==='name'){
                var currentChar = 0;
                var tt = $('<p>');
                m.indices.forEach((i)=>{
                    var part = $('<span>');
                    part.append(r.item.name.substr(currentChar,i[0]));
                    tt.append(part);
                    part = $('<span>').css('color','red');
                    part.append(r.item.name.substr(i[0],i[1]+1));
                    tt.append(part);
                    currentChar = i[1]+1;
                });
                var part = $('<span>');
                part.append(r.item.name.substr(currentChar));
                tt.append(part);
                col.append(tt);
            }
        });
        row.append(col);

        var col = $('<td>');
        col.append('<h4>'+r.item.city+'</h4>');

        
        r.matches.forEach((m)=>{
            if(m.key==='city'){
                var currentChar = 0;
                var tt = $('<p>');
                m.indices.forEach((i)=>{
                    var part = $('<span>');
                    part.append(r.item.city.substr(currentChar,i[0]));
                    tt.append(part);
                    part = $('<span>').css('color','red');;
                    part.append(r.item.city.substr(i[0],i[1]+1));
                    tt.append(part);
                    currentChar = i[1]+1;
                });
                var part = $('<span>');
                part.append(r.item.city.substr(currentChar));
                tt.append(part);
                col.append(tt);
            }
        });
        row.append(col);

		row.append('<td>'+r.item.plz +'</td>');
		row.append('<td>'+r.item.street +'</td>');
        row.append('<td>'+r.score +'</td>');
        $("#resultTable").append(row);
	});
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

