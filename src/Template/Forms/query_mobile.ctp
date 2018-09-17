<?php $this->assign('title','Kontaktformulare'); ?>
<?= $this->Form->create(); ?>
<fieldset>
<?php
			if( $this->request->session()->read('Auth.User.role') == 'admin'){
			    
				 echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
			}
			?>
			<div class='input text'>
			<label for='from'>Von</label>
			<input id ='from' type='text' name='from' class='datepicker'>
			</div>
			<div class='input text'>
			<label for='to'>Bis</label>
			<input id ='to' type='text' name='to' class='datepicker'>
			</div>
			<script>
			$(".datepicker").datepicker( $.datepicker.regional[ "de" ] );
			$(".datepicker").css( 'width', '8em');
			</script>
			<?php foreach($filters as $f){
			$name = 'filter[' . $f->id . ']';
			$choices = array();
			foreach($f->choices as $c){
				$choices[$c->id] = $c->text;
			}
			echo $this->Form->input($name,['options' => $choices
										  ,'label' => $f->text
										  , 'empty' => true]);
			 } ?>
			</fieldset>
<?= $this->Form->button(__('Anzeigen')); ?>

<?= $this->Form->end() ?>

<div class="forms index large-9 medium-8 columns content">
	<?php if (isset($forms)): ?>
    <h3><?= sizeof($forms ) . ' Treffer' ?></h3>
	<tiny>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <?php foreach ($forms as $form): ?>
            <tr>
			<table cellpadding="0" cellspacing="0">

			<thead>
			<tr>
                <th><?= date_format($form->created,'d.m.Y H:i' )  ?></th>
				<th><?= $form->customer->name ?></th>
				<th><?= $form->customer->city ?></th>
			</tr>
			</thead>
			</table>
			<table class="vertical-table">
			<tr><th></th>
				 <td><?= $this->Html->link(__('Ansehen'), ['action' => 'view', $form->id]) ?></td>
				 </tr>
			    <?php foreach ($shortQ as $sq): ?>
				<tr>
				<th><?= $sq->short ?></th>
				<td><?= !empty($form->shortA[$sq->id]) ? $form->shortA[$sq->id] : 'k.A.' ?></td>
				</tr>
				<?php endforeach; ?>
			</table>	
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
	</small>
	<?php endif; ?>
</div>