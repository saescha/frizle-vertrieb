<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Alle Fragen'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Alle Antwortsmöglichkeiten'), ['controller' => 'Choices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Neue Antwort anlegen'), ['controller' => 'Choices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questions form large-9 medium-8 columns content">
    <?= $this->Form->create($question) ?>
    <fieldset>
        <legend><?= __('Frage hinzuf&uuml;gen') ?></legend>
        <?php
            echo $this->Form->input('text');
            echo $this->Form->input('sequence_number');
            echo $this->Form->input('type',['options' => [ 'F' => 'Freitext','C' =>'Mehrere Antworten', 'R' => 'Eine Antwort']]);
                        echo $this->Form->input('short');
            echo $this->Form->input('filterable');
            echo $this->Form->input('inactive');
			echo $this->Form->input('customer_question');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>