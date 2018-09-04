<?php $this->assign('title','Verkostungen'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Neuer Verkostungstermin'), ['action' => 'add']) ?></li>
       <!-- <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li> -->
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="events index large-9 medium-8 columns content">
    <h3><?= __('Verkostungen') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
          <!--      <th><?= $this->Paginator->sort('id') ?></th> -->
                <th><?= $this->Paginator->sort('customer_id','Markt') ?></th>
                <th><?= $this->Paginator->sort('date','Datum') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('promoter') ?></th>
                <th><?= $this->Paginator->sort('comment') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
            <!--    <td><?= $event->id ?></td> -->
                <td><?= $event->has('customer') ? $this->Html->link($event->customer->name, ['controller' => 'Customers', 'action' => 'view', $event->customer->id]) : '' ?></td>
                <td><?= date_format($event->date,'d.m.Y' ) ?></td>
                <td><?= h($event->status) ?></td>
                <td><?= h($event->promoter) ?></td>
                <td><?= h($event->comment) ?></td>
                <td><?= $event->has('user' ) ? $this->Html->link($event->user->username, ['controller' => 'Customers', 'action' => 'view', $event->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['action' => 'view', $event->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['action' => 'edit', $event->id]) ?>
                    <?= $this->Form->postLink(__('Entfernen'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>