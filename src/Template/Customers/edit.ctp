<?php $this->assign('title', 'Märkte'); 
  // $customer['Customer'] = $customer;
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aktionen') ?></li>
        <li><?= $this->Html->link(__('Märkte verwalten'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Alle User'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('User anlegen'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="customers form large-9 medium-8 columns content">
    <?= $this->Form->create($Customer) ?>
    <fieldset>
        <legend><?= __('Markt hinzuf&uuml;gen') ?></legend>
        <?php
            echo $this->Form->input('Customer.name');
			echo $this->Form->input('Customer.plz', array('label' => 'Postleitzahl'));
            echo $this->Form->input('Customer.city', array('label' => 'Stadt'));
            echo $this->Form->input('Customer.street', array('label' => 'Straße'));
            echo $this->Form->input('Customer.category_id', ['options' => $categories, 'empty' => true]);
                        if ($this->request->session()->read('Auth.User.role') == 'admin') {
                            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
                        }

        ?>

    
	<?php
foreach ($questions as $q) {
            if ($q->type == 'C') {
                echo $this->Form->label($q->text);
                foreach ($q->choices as $c) {
                    echo '<label>';
                    echo $this->Form->checkbox('Question.'. $c->id, [
                            'value' => $c->id,
                            'checked' => !empty($c->answers)
                            ]);
                    echo $c->text;
                    echo '</label>';
                   
                }
            } elseif ($q->type == 'R') {
                $radio = array();
                $value = null;
                foreach ($q->choices as $c) {
                    if(!empty($c->answers))$value=$c->id;
                    array_push($radio, [ 'value' => $c->id , 'text' => $c->text ]);
                }
                echo $this->Form->input('Question.'. $q->id, ['options' => $radio, 'label' =>  $q->text ,'empty' => true, 'value' => $value]);
            } elseif ($q->type == 'F') {
                $value = null;
                foreach ($q->choices as $c) {
                    if(!empty($c->answers))$value=$c->text;
                }
                echo $this->Form->input('FQuestion.'. $q->id, [ 'id' => $q->id , 'label' => $q->text, 'value' => $value ]);
            }
        }
 ?>
 </fieldset>
    <?= $this->Form->button(__('Speichern')) ?>
    <?= $this->Form->end() ?>

</div>