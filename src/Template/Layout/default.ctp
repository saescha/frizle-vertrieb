<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
		frizle - Vertrieb
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('jquery-ui.min.css') ?>
	<?= $this->Html->script('jquery-1.8.2.min')?>
	<?= $this->Html->script('jquery.hideseek.min')?>
	<?= $this->Html->script('jquery-ui.min')?>
	<?= $this->Html->script('datepicker-de')?>
    <?= $this->Html->script('main')?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <section class="top-bar-section">
            <ul class="right">
                <li><?= $this->Html->link(__('Ausloggen'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
                <li><?= $this->Html->link(__('Startseite'), ['controller' => 'Pages', 'action' => 'home']) ?></li>
            </ul>
        </section>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
</body>
</html>
