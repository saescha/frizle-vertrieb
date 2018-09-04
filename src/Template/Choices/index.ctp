<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Neue Antwort anlegen'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Alle Fragen'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neue Frage anlegen'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="choices index large-9 medium-8 columns content">
    <h3><?= __('Antworten') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('Fragen') ?></th>
                <th><?= $this->Paginator->sort('text') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($choices as $choice): ?>
            <tr>
                <td><?= $choice->id ?></td>
                <td><?= $choice->has('question') ? $this->Html->link($choice->question->text, ['controller' => 'Questions', 'action' => 'view', $choice->question->id]) : '' ?></td>
                <td><?= h($choice->text) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['action' => 'view', $choice->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['action' => 'edit', $choice->id]) ?>
                    <?= $this->Form->postLink(__('Entfernen'), ['action' => 'delete', $choice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $choice->id)]) ?>
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