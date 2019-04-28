<?= $this->Html->css('form.css') ?>

<p class="lead">ログイン</p>

<!-- フラッシュメッセージの表示位置を指定 -->
<?= $this->Flash->render('auth') ?>

<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>