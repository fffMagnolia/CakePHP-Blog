<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<?= $this->Html->css('form.css') ?>

<p><?= $this->Html->link(__('↩︎'), ['action' => 'admin']) ?></p>
<p class="lead"><?= __('Edit Article') ?></p>
<?= $this->Form->create($article) ?>
<div class="form-group"><?= $this->Form->control('title', ['class' => 'form-control']); ?></div>
<div class="form-group"><?= $this->Form->control('body', ['class' => 'form-control', 'rows' => '15']); ?></div>
<div class="form-group"><?= $this->Form->button('Submit', ['class' => 'btn btn-default clearfix pull-right']) ?></div>
<?= $this->Form->end() ?>