<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Frage bearbeiten'), ['action' => 'edit', $question->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Frage entfernen'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
        <li><?= $this->Html->link(__('Alle Fragen'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Neue Frage anlegen'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Alle Antwortsmöglichkeiten'), ['controller' => 'Choices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Neue Antwortsmöglichkeit anlegen'), ['controller' => 'Choices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($question->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($question->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $question->id ?></td>
        </tr>
        <tr>
            <th><?= __('Sequence Number') ?></th>
            <td><?= $question->sequence_number ?></td>
        </tr>
                <tr>
            <th><?= __('Kurztext') ?></th>
            <td><?= $question->short ?></td>
        </tr>
        <tr>
            <th><?= __('filterable') ?></th>
            <td><?= $question->filterable ? __('Ja') : __('Nein'); ?></td>
        </tr>
                <tr>
         <th><?= __('Inactive') ?></th>
            <td><?= $question->inactive ? __('Ja') : __('Nein'); ?></td>
        </tr>
		<tr>
         <th><?= __('Marktspezifisch') ?></th>
            <td><?= $question->customer_question ? __('Ja') : __('Nein'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Assoziierte Antwortsmöglichkeiten') ?></h4>
        <?php if (!empty($question->choices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Fragen Id') ?></th>
                <th><?= __('Text') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
            <?php foreach ($question->choices as $choices): ?>
            <tr>
                <td><?= h($choices->id) ?></td>
                <td><?= h($choices->question_id) ?></td>
                <td><?= h($choices->text) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['controller' => 'Choices', 'action' => 'view', $choices->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['controller' => 'Choices', 'action' => 'edit', $choices->id]) ?>
                    <?= $this->Form->postLink(__('Entfernen'), ['controller' => 'Choices', 'action' => 'delete', $choices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $choices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>