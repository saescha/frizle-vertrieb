<?php $this->assign('title','Kontaktpersonen'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Neue Kontaktperson'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Märkte verwalten'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="persons index large-9 medium-8 columns content">
    <h3><?= __('Persons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('Vorname') ?></th>
                <th><?= $this->Paginator->sort('Nachname') ?></th>
                <th><?= $this->Paginator->sort('position') ?></th>
                <th><?= $this->Paginator->sort('phone1') ?></th>
                <th><?= $this->Paginator->sort('phone2') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($persons as $person): ?>
            <tr>
                <td><?= h($person->first_name) ?></td>
                <td><?= h($person->last_name) ?></td>
                <td><?= h($person->position) ?></td>
                <td><?= h($person->phone1) ?></td>
                <td><?= h($person->phone2) ?></td>
                <td><?= h($person->email) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['action' => 'view', $person->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['action' => 'edit', $person->id]) ?>
                    <?= $this->Form->postLink(__('Löschen'), ['action' => 'delete', $person->id], ['confirm' => __('Are you sure you want to delete # {0}?', $person->id)]) ?>
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