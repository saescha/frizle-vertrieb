<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Antwort bearbeiten'), ['action' => 'edit', $choice->id]) ?> </li>
        <li><a href="#" onclick="confirmNavigate('Sicher?','/choices/delete/<?= $choice->id ?>' );"> Antwort löschen </a>
        <li><?= $this->Html->link(__('Alle Antworten'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Antwort anlegen'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Alle Fragen'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Frage anlegen'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="choices view large-9 medium-8 columns content">
    <h3><?= h($choice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Frage') ?></th>
            <td><?= $choice->has('question') ? $this->Html->link($choice->question->id, ['controller' => 'Questions', 'action' => 'view', $choice->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($choice->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $choice->id ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Assoziierte Antworten') ?></h4>
        <?php if (!empty($choice->answers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Choice Id') ?></th>
                <th><?= __('Form Id') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
            <?php foreach ($choice->answers as $answers): ?>
            <tr>
                <td><?= h($answers->id) ?></td>
                <td><?= h($answers->choice_id) ?></td>
                <td><?= h($answers->form_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['controller' => 'Answers', 'action' => 'view', $answers->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['controller' => 'Answers', 'action' => 'edit', $answers->id]) ?>
                    <?= $this->Form->postLink(__('Entfernen'), ['controller' => 'Answers', 'action' => 'delete', $answers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>