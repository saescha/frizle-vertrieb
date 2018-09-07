<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Choices'), ['controller' => 'Choices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Choice'), ['controller' => 'Choices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="answers index large-9 medium-8 columns content">
    <h3><?= __('Answers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('choice_id') ?></th>
                <th><?= $this->Paginator->sort('form_id') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($answers as $answer): ?>
            <tr>
                <td><?= $answer->id ?></td>
                <td><?= $answer->has('choice') ? $this->Html->link($answer->choice->id, ['controller' => 'Choices', 'action' => 'view', $answer->choice->id]) : '' ?></td>
                <td><?= $answer->has('form') ? $this->Html->link($answer->form->id, ['controller' => 'Forms', 'action' => 'view', $answer->form->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $answer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $answer->id]) ?>
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
