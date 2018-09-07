<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Neue Frage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Alle Antwortsmöglichkeiten'), ['controller' => 'Choices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neue Antwortsmöglichkeit anlegen'), ['controller' => 'Choices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questions index large-9 medium-8 columns content">
    <h3><?= __('Fragen') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('text') ?></th>
                <th><?= $this->Paginator->sort('sequence_number') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                                <th><?= $this->Paginator->sort('short') ?></th>
                <th><?= $this->Paginator->sort('filterable') ?></th>
                <th><?= $this->Paginator->sort('inactive') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $question->id ?></td>
                <td><?= h($question->text) ?></td>
                <td><?= $question->sequence_number ?></td>
                <td><?= h($question->type) ?></td>
                                <td><?= h($question->short) ?></td>
                <td><?= h($question->filterable) ?></td>
                <td><?= h($question->inactive) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['action' => 'view', $question->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['action' => 'edit', $question->id]) ?>
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