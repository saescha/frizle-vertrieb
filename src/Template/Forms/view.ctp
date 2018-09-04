<?php $this->assign('title','Kontaktformulare'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>

        <li><?= $this->Form->postLink(__('Kontaktformular löschen'), ['action' => 'delete', $form->id], ['confirm' => __('Are you sure you want to delete # {0}?', $form->id)]) ?> </li>
		<li><?= $this->Html->link(__('Neues Kontaktformular'), ['controller' => 'Questions', 'action' => 'answer']) ?></li>
		<li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?></li>

    </ul>
</nav>
<div class="forms view large-9 medium-8 columns content">
    <h3>Kontaktformular</h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Markt') ?></th>
            <td><?= $form->has('customer') ? $this->Html->link($form->customer->name, ['controller' => 'Customers', 'action' => 'view', $form->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $form->has('user') ? $this->Html->link($form->user->username, ['controller' => 'Users', 'action' => 'view', $form->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Erstellt') ?></th>
            <td><?= date_format($form->created,'d.m.Y H:i' ) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Antworten') ?></h4>
        <?php if (!empty($form->answers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
				<th><?= __('Frage') ?></th>
				<th><?= __('Antwort') ?></th>
            </tr>
            <?php foreach ($form->answers as $answers): ?>
            <tr>
				<td><?= h($answers->choice->question->text) ?></td>
				<td><?= h($answers->choice->text) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>

</div>
