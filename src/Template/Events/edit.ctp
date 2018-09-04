<?php $this->assign('title','Verkostungen'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $event->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Edit Event') ?></legend>
		 <div class='input text'>
			<label for='datepick'>Datum</label>
			<input id ='datepick' type='text' name='datepick' class='datepicker'>
			</div>
			<script>
			$(".datepicker").datepicker( $.datepicker.regional[ "de" ] );
			$(".datepicker").css( 'width', '8em');
			</script>
        <?php
            echo $this->Form->hidden('customer_id');
            echo $this->Form->hidden('user_id');
            echo $this->Form->input('status',['options' => ['N' => 'Neu','O' => 'Offen','P' => 'Geplant','C' => 'Abgeschlossen','X' => 'Abgesagt']]);
            echo $this->Form->input('promoter');
            echo $this->Form->input('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
