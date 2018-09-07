<?php $this->assign('title', 'Märkte'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Markt bearbeiten'), ['action' => 'edit', $customer->id]) ?> </li>
        <li><a href="#" onclick="confirmNavigate('Sicher?','/customers/delete/<?= $customer->id ?>' );"> Markt löschen </a>
                <li><?= $this->Html->link(__('Kontaktformular zu diesem Markt erstellen'), ['controller' => 'Questions', 'action' => 'answer',$customer->id]) ?> </li>
                <li><?= $this->Html->link(__('Kontaktperson zu diesem Markt erstellen'), ['controller' => 'Persons', 'action' => 'add',$customer->id]) ?> </li>
                <li><?= $this->Html->link(__('Verkostungstermin zu diesem Markt erstellen'), ['controller' => 'Events', 'action' => 'add',$customer->id]) ?> </li>
        <li><?= $this->Html->link(__('Märkte verwalten'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customers view large-9 medium-8 columns content">
    <h3><?= h($customer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($customer->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Stadt') ?></th>
            <td><?= h($customer->city) ?></td>
        </tr>
        <tr>
            <th><?= __('Postleitzahl') ?></th>
            <td><?= h($customer->plz) ?></td>
        </tr>
        <tr>
            <th><?= __('Straße') ?></th>
            <td><?= h($customer->street) ?></td>
        </tr>
                <tr>
            <th><?= __('Kategorie') ?></th>
            <td><?= $customer->has('category') ? h($customer->category->name) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $customer->has('user') ? $this->Html->link($customer->user->username, ['controller' => 'Users', 'action' => 'view', $customer->user->id]) : '' ?></td>
        </tr>

        <?php foreach ($customer->answers as $answers): ?>
            <tr>
				<th><?= h($answers->choice->question->text) ?></th>
				<td><?= h($answers->choice->text) ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
        <div class="related">
        <h4><?= __('Kontaktpersonen') ?></h4>
        <?php if (!empty($customer->persons)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Nachname') ?></th>
                <th><?= __('Vorname') ?></th>
    <!--            <th><?= __('Position') ?></th>
                                <th><?= __('Telefon') ?></th>
                                <th><?= __('Mobil') ?></th>
                                <th><?= __('Email') ?></th> -->
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
            <?php foreach ($customer->persons as $person): ?>
            <tr>
                <td><?= $person->last_name ?></td>
                <td><?= $person->first_name ?></td>
        <!--        <td><?= $person->position ?></td>
                <td><?= $person->phone1 ?></td>
                <td><?= $person->phone2 ?></td>
                <td><?= $person->email ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['controller' => 'Persons', 'action' => 'view', $person->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
                <div class="related">
        <h4><?= __('Verkostungen') ?></h4>
        <?php if (!empty($customer->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Datum') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Promoter') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
            <?php foreach ($customer->events as $event): ?>
            <tr>
                <td><?= date_format($event->date, 'd.m.Y') ?></td>
                <td><?php switch ($event->status) {

                                                        case 'O': echo 'Offen';break;
                                                        case 'P': echo 'Geplant';break;
                                                        case 'C': echo 'Abgeschlossen';break;
                                                        case 'X': echo 'Abgesagt';break;
                                                        case 'N': echo 'Neu';break;}?></td>
                <td><?= $event->promoter ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['controller' => 'Events', 'action' => 'view', $event->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['controller' => 'Events', 'action' => 'edit', $event->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Kontaktformulare') ?></h4>
        <?php if (!empty($customer->forms)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>

                <th><?= __('Erstellt') ?></th>
                <th class="actions"><?= __('Aktionen') ?></th>
            </tr>
            <?php foreach ($customer->forms as $forms): ?>
            <tr>

                <td><?= date_format($forms->created, 'd.m.Y H:i') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ansehen'), ['controller' => 'Forms', 'action' => 'view', $forms->id]) ?>
                    <?= $this->Html->link(__('Bearbeiten'), ['controller' => 'Forms', 'action' => 'edit', $forms->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>