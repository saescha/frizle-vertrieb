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
			</fieldset>
<?= $this->Form->button(__('Anzeigen')); ?>

<?= $this->Form->end() ?>

<div class="forms index large-9 medium-8 columns content">
    <h3><?= __('Kontaktformulare') ?></h3>
	<?php if (!empty($forms)): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Tag</th>
                <th>Uhrzeit</th>
                <th>Markt</th>
                <th>Stadt</th>
				<th>Erstkontakt</th>
				<th>Art des Kontakts</th>
				<th>Frizle im Sortiment</th>
				<th>Abverkauf Ei</th>
				
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
				<td><?php 
					foreach($form->answers as $a){
						if( $a->choice_id == 55 ){
							echo 'Ja';
							break;}
						if( $a->choice_id == 56 ){
							echo 'Nein';
							break;}
					}
				?></td>
				<td><?php 
					foreach($form->answers as $a){
						if( $a->choice_id == 1 ){
							echo 'Telefonisch';
							break;}
						if( $a->choice_id == 2 ){
							echo 'Persönlich';
							break;}
					}
				?></td>
				<td><?php 
					foreach($form->answers as $a){
						if( $a->choice_id == 3 ){
							echo 'Ja';
							break;}
						if( $a->choice_id == 4 ){
							echo 'Nein';
							break;}
					}
				?></td>
				<td><?php 
					foreach($form->answers as $a){
						if( $a->choice_id == 12 ){
							echo 'weniger als 2';
							break;}
						if( $a->choice_id == 13 ){
							echo 'ca. 2';
							break;}
						if( $a->choice_id == 14 ){
							echo 'ca. 4';
							break;}
						if( $a->choice_id == 15){
							echo 'ca. 6';
							break;}
						if( $a->choice_id == 16){
							echo 'mehr als 6';
							break;}
					}
				?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $form->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $form->id], ['confirm' => __('Are you sure you want to delete # {0}?', $form->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php endif; ?>
</div>