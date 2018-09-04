<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'Löschen', $choice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $choice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Alle Antworten'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Alle Fragen'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Frage hinzufügen'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="choices form large-9 medium-8 columns content">
    <?= $this->Form->create($choice) ?>
    <fieldset>
        <legend><?= __('Antwort bearbeiten') ?></legend>
        <?php
            echo $this->Form->input('question_id', ['options' => $questions, 'empty' => true]);
            echo $this->Form->input('text');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Speichern')) ?>
    <?= $this->Form->end() ?>
</div>