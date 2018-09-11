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
                
                m.indices.forEach((i)=>{
                    var tt = $('<p>');
                    var part = $('<span>');
                    part.append(r.item.name.substring(0,i[0]));
                    tt.append(part);
                    part = $('<span>').css('color','red');
                    part.append(r.item.name.substring(i[0],i[1]+1));
                    tt.append(part);
                    part = $('<span>');
                    part.append(r.item.name.substring(i[1]+1));
                    tt.append(part);
                    col.append(tt);
                });
                
            }
        });
        row.append(col);

        var col = $('<td>');
        col.append('<h4>'+r.item.city+'</h4>');

        
        r.matches.forEach((m)=>{
            if(m.key==='city'){
                m.indices.forEach((i)=>{
                    var tt = $('<p>');
                    var part = $('<span>');
                    part.append(r.item.city.substring(0,i[0]));
                    tt.append(part);
                    part = $('<span>').css('color','red');
                    part.append(r.item.city.substring(i[0],i[1]+1));
                    tt.append(part);
                    part = $('<span>');
                    part.append(r.item.city.substring(i[1]+1));
                    tt.append(part);
                    col.append(tt);
                });
            }
        });
        row.append(col);

        var col = $('<td>');
        col.append('<h4>'+r.item.concat+'</h4>');

        
        r.matches.forEach((m)=>{
            if(m.key==='concat'){
                m.indices.forEach((i)=>{
                    var tt = $('<p>');
                    var part = $('<span>');
                    part.append(r.item.concat.substring(0,i[0]));
                    tt.append(part);
                    part = $('<span>').css('color','red');
                    part.append(r.item.concat.substring(i[0],i[1]+1));
                    tt.append(part);
                    part = $('<span>');
                    part.append(r.item.concat.substring(i[1]+1));
                    tt.append(part);
                    col.append(tt);
                });
            }
        });
        row.append(col);


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

                <th>Name</th>
                <th>Stadt</th>
                <th>Concat</th>
                <th>Straße</th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody id="resultTable">
        </tbody>
	</table>


</div>

