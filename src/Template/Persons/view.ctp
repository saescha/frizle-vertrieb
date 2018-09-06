<?php $this->assign('title','Kontaktpersonen'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Kontaktperson ändern'), ['action' => 'edit', $person->id]) ?> </li>
        <li><a href="#" onclick="confirmNavigate('Sicher?','/persons/delete/<?= $person->id ?>' );"> Kontaktperson löschen </a>
        <li><?= $this->Html->link(__('Kontaktpersonen verwalten'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Neue Kontaktperson'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Märkte verwalten'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="persons view large-9 medium-8 columns content">
    <h3><?= h($person->last_name) ?>,<?= h($person->first_name) ?> </h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Vorname') ?></th>
            <td><?= h($person->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Nachname') ?></th>
            <td><?= h($person->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Position') ?></th>
            <td><?= h($person->position) ?></td>
        </tr>
        <tr>
            <th><?= __('Telefon') ?></th>
            <td><?= $this->Html->link($person->phone1, 'tel://'.$person->phone1) ?></td>
        </tr>
        <tr>
            <th><?= __('Mobil') ?></th>
            <td><?= $this->Html->link($person->phone2, 'tel://'.$person->phone2) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= $this->Html->link($person->email, 'mailto:'.$person->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Markt') ?></th>
            <td><?= $person->has('customer') ? $this->Html->link($person->customer->name, ['controller' => 'Customers', 'action' => 'view', $person->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $person->id ?></td>
        </tr>
    </table>
</div>
