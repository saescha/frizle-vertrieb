<?php $this->assign('title','frizle -  Vertrieb'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Neues Kontaktformular'), ['controller' => 'Questions', 'action' => 'answer']) ?></li>
        <li><?= $this->Html->link(__('Neuen Markt anlegen'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Meine Märkte verwalten'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Markt finden'), ['controller' => 'Customers', 'action' => 'search']) ?></li>
		<li><?= $this->Html->link(__('Neue Kontaktperson'), ['controller' => 'Persons', 'action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('Verkostungstermine verwalten'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Meine Kontakteformulare verwalten'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Kontaktformulare durchsuchen'), ['controller' => 'Forms', 'action' => 'query']) ?></li>
		
    </ul>
	<?php if( $this->request->session()->read('Auth.User.role') == 'admin'){ ?>
	    <ul class="side-nav">
        <li class="heading"><?= __('Admin') ?></li>
		
        <li><?= $this->Html->link(__('Benutzer verwalten'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Fragen verwalten'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Antworten verwalten'), ['controller' => 'Choices', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Märkte verwalten'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Kontaktformulare'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Kontaktformulare durchsuchen'), ['controller' => 'Forms', 'action' => 'query']) ?></li>
		
    </ul>
	<?php } ?>
</nav>