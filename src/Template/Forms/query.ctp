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
	
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Tag</th>
                <th>Uhrzeit</th>
                <th>Markt</th>
                <th>Stadt</th>
				
				<?php foreach ($shortQ as $sq): ?>
				<th><?= $sq->short ?></th>

				<?php endforeach; ?>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($forms as $form): ?>
            <tr>
                <td><?= date_format($form->created,'d.m.Y' )  ?></td>
				<td><?= date_format($form->created,'H:i' ) ?></td>
				<td><?= $form->customer->name ?></td>
				<td><?= $form->customer->city ?></td>
				<?php foreach ($shortQ as $sq): ?>
				<td><?= !empty($form->shortA[$sq->id]) ? $form->shortA[$sq->id] : 'k.A.' ?></td>

				<?php endforeach; ?>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $form->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php endif; ?>
</div>