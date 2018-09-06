<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id]) ?> </li>
        <li><a href="#" onclick="confirmNavigate('Sicher?','/answers/delete/<?= $answer->id ?>' );"> Antwort löschen </a>
        <li><?= $this->Html->link(__('List Answers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Choices'), ['controller' => 'Choices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Choice'), ['controller' => 'Choices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="answers view large-9 medium-8 columns content">
    <h3><?= h($answer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Choice') ?></th>
            <td><?= $answer->has('choice') ? $this->Html->link($answer->choice->id, ['controller' => 'Choices', 'action' => 'view', $answer->choice->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Form') ?></th>
            <td><?= $answer->has('form') ? $this->Html->link($answer->form->id, ['controller' => 'Forms', 'action' => 'view', $answer->form->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $answer->id ?></td>
        </tr>
    </table>
</div>
