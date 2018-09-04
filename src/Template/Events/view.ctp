<?php $this->assign('title','Verkostungen'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Verkostung bearbeiten'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Verkostung entfernen'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('Alle Verkostungen'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Neue Verkostung eintragen'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Alle Märkte'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Markt') ?></th>
            <td><?= $event->has('customer') ? $this->Html->link($event->customer->name, ['controller' => 'Customers', 'action' => 'view', $event->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($event->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Promoter') ?></th>
            <td><?= h($event->promoter) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $event->id ?></td>
        </tr>
        <tr>
            <th><?= __('Datum') ?></th>
            <td><?= date_format($event->date,'d.m.Y' ) ?></td>
        </tr>
                <tr>
            <th><?= __('Kommentar') ?></th>
            <td><?= $event->comment ?></td>
        </tr>
                <tr>
            <th><?= __('User') ?></th>
            <td><?= $event->has('user') ? $this->Html->link($event->user->username, ['controller' => 'Customers', 'action' => 'view', $event->user->id]) : '' ?></td>
        </tr>
    </table>
</div>