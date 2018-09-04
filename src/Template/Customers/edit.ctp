<?php $this->assign('title','Märkte'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Form->postLink(
                __('Löschen'),
                ['action' => 'delete', $customer->id],
                ['confirm' => __('Sind Sie sich sicher? # {0}?', $customer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Märkte verwalten'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Alle User'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('User anlegen'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="customers form large-9 medium-8 columns content">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Markt bearbeiten') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('city',array('label' => 'Stadt'));
            echo $this->Form->input('street',array('label' => 'Straße'));
                        echo $this->Form->input('category_id', ['options' => $categories, 'empty' => true]);
            if( $this->request->session()->read('Auth.User.role') == 'admin'){

                                echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
                        }
        ?>
    </fieldset>
	<?php 

foreach( $questions as $q ){
	echo '<div>';
	echo $q->text;
	echo '</div>';
	echo  '<fieldset>';
	if ( $q->type == 'C'){
	
	foreach( $q->choices as $c){
	echo '<label>';
	echo $this->Form->checkbox('C'. $c->id, [
    'value' => $c->id
	]);
	echo $c->text;
	echo '</label>';
	}
}
elseif($q->type == 'R'){
	$radio = array();
	foreach( $q->choices as $c){
		array_push( $radio, [ 'value' => $c->id , 'text' => $c->text ] );
	}
	echo $this->Form->radio( $q->id , $radio );
	
}elseif($q->type == 'F'){
	echo $this->Form->input( $q->id, [ 'id' => $q->id , 'label' => '' ] );
}
echo '</fieldset>';

	
}

 ?>
    <?= $this->Form->button(__('Speichern')) ?>
    <?= $this->Form->end() ?>
</div>