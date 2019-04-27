<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<?= $this->Html->css('form.css') ?>

<p><?= $this->Html->link(__('↩︎'), ['action' => 'admin']) ?></p>
<p class="lead"><?= __('Add Article') ?></p>
<!-- 複数のMIMEタイプを扱うためmultipart...を指定-->
<?= $this->Form->create($article, ['enctype' => 'multipart/form-data']) ?>
<div class="form-group"><?= $this->Form->control('title', ['class' => 'form-control']); ?></div>
<div class="form-group"><?= $this->Form->control('body', ['class' => 'form-control', 'rows' => '15']); ?></div>
<?php     
    //検証用なのでコメントアウトしている
    //サムネイル機能の検証時に使用予定
    //echo $this->Form->file('icon');
?>
<div class="form-group"><?= $this->Form->button('Submit', ['class' => 'btn btn-default clearfix pull-right']) ?></div>
<?= $this->Form->end() ?>