<?php $this->assign('title','Verkostungen'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Alle Verkostungen'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Alle Märkte'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Verkostung eintragen') ?></legend>
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
<?php } ?>



            <div class='input text'>
                        <label for='datepick'>Datum</label>
                        <input id ='datepick' type='text' name='datepick' class='datepicker'>
                        </div>
                        <script>
                        $(".datepicker").datepicker( $.datepicker.regional[ "de" ] );
                        $(".datepicker").css( 'width', '8em');
                        </script>
        <?php    echo $this->Form->input('promoter');
                 echo $this->Form->input('Kommentar');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Speichern')) ?>
    <?= $this->Form->end() ?>
</div>