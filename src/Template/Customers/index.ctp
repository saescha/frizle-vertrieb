<?php $this->assign('title','Märkte'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Alle User'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neuen User anlegen'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="customers index large-9 medium-8 columns content">
    <h3><?= __('Märkte') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('name','Name') ?></th>
                <th><?= $this->Paginator->sort('city','Stadt') ?></th>
                <th><?= $this->Paginator->sort('street','Straße') ?></th>
   <!--         <th><?= $this->Paginator->sort('category_id','Kategorie') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('created','erstellt') ?></th>
                <th><?= $this->Paginator->sort('modified','geändert') ?></th>  -->
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
            <tr>

                <td><?= h($customer->name) ?></td>
                <td><?= h($customer->city) ?></td>
                <td><?= h($customer->street) ?></td>
          <!--  <td><?= $customer->has('category') ? h($customer->category->name) : '' ?></td>
                <td><?= $customer->has('user') ? $this->Html->link($customer->user->username, ['controller' => 'Users', 'action' => 'view', $customer->user->id]) : '' ?></td>
                <td><?= date_format($customer->created,'d.m.Y H:i' ) ?></td>
                <td><?= date_format($customer->modified,'d.m.Y H:i' ) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['action' => 'view', $customer->id]) ?>
                <!--                <?= $this->Html->link(__('Ändern'), ['action' => 'edit', $customer->id]) ?>
                    <?= $this->Form->postLink(__('Löschen'), ['action' => 'delete', $customer->id], ['confirm' => __('Sind sie sicher?', $customer->id)]) ?> -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('zurück')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('vor') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>