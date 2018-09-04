
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Neuen User anlegen'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Alle Märkte'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
      <!--  <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li> -->
      <!--  <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li> -->
    </ul>
</nav>

<div class="users index large-9 medium-8 columns content">
    <h3><?= __('User') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
     <!--         <th><?= $this->Paginator->sort('password') ?></th> -->
                <th><?= $this->Paginator->sort('role') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= h($user->username) ?></td>
         <!--       <td><?= h($user->password) ?></td> -->
                <td><?= h($user->role) ?></td>
               <td><?= 'TBD' ?></td>
                <td><?= 'TBD' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Entfernen'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete {0}?', $user->id)]) ?>
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
