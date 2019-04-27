<?= $this->Html->css('form.css') ?>

<p class="lead">ログイン</p>
<?= $this->Form->create() ?>
<div class="form-group"><?= $this->Form->control('email', ['class' => 'form-control']) ?></div>
<div class="form-group"><?= $this->Form->control('password', ['class' => 'form-control']) ?></div>
<div class="form-group"><?= $this->Form->button('Login', ['class' => 'btn btn-default clearfix pull-right']) ?></div>
<?= $this->Form->end() ?>