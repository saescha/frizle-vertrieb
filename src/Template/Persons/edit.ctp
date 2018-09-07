<?php $this->assign('title','Kontaktpersonen'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Kontaktpersonen verwalten'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Märkte verwalten'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="persons form large-9 medium-8 columns content">
    <?= $this->Form->create($person) ?>
    <fieldset>
        <legend><?= __('Kontaktperson ändern') ?></legend>
        <?php
            echo $this->Form->input('first_name',array('label' => 'Vorname'));
            echo $this->Form->input('last_name',array('label' => 'Nachname'));
            echo $this->Form->input('position');
            echo $this->Form->input('phone1');
            echo $this->Form->input('phone2');
            echo $this->Form->input('email');
            echo $this->Form->hidden('customer_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Speichern')) ?>
    <?= $this->Form->end() ?>
</div>