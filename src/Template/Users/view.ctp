<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><a href="#" onclick="confirmNavigate('Sicher?','/users/delete/<?= $user->id ?>' );"> User löschen </a>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Passwort') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Rolle') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $user->id ?></td>
        </tr>
        <tr>
            <th><?= __('Erstellt') ?></th>
            <td><?= 'TBD' ?></td>
        </tr>
        <tr>
            <th><?= __('Bearbeitet') ?></th>
            <td><?= 'TBD' ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Assoziierte M�rkte') ?></h4>
        <?php if (!empty($user->customers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Stadt') ?></th>
                <th><?= __('Straße') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Erstellt') ?></th>
                <th><?= __('Bearbeitet') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->customers as $customers): ?>
            <tr>
                <td><?= h($customers->id) ?></td>
                <td><?= h($customers->name) ?></td>
                <td><?= h($customers->city) ?></td>
                <td><?= h($customers->street) ?></td>
                <td><?= h($customers->user_id) ?></td>
                <td><?= 'TBD' ?></td>
                <td><?= 'TBD' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['controller' => 'Customers', 'action' => 'view', $customers->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['controller' => 'Customers', 'action' => 'edit', $customers->id]) ?>
                    <?= $this->Form->postLink(__('Entfernen'), ['controller' => 'Customers', 'action' => 'delete', $customers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Assoziierte Kontaktformulare') ?></h4>
        <?php if (!empty($user->forms)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Markt Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Erstellt') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->forms as $forms): ?>
            <tr>
                <td><?= h($forms->id) ?></td>
                <td><?= h($forms->customer_id) ?></td>
                <td><?= h($forms->user_id) ?></td>
                <td><?= 'TBD' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['controller' => 'Forms', 'action' => 'view', $forms->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['controller' => 'Forms', 'action' => 'edit', $forms->id]) ?>
                    <?= $this->Form->postLink(__('Entfernen'), ['controller' => 'Forms', 'action' => 'delete', $forms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forms->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>