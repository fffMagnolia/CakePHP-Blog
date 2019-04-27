<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<?= $this->Html->css('view.css') ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="container-fluid">
    <div class="row title">
        <p class="lead"><?= h($article->title) ?></p>
    </div>
    <div class="row main">
        <?= $this->Text->autoParagraph(h($article->body)); ?>
    </div class="row">
        <p class="text-right">最終更新日： <?= h($article->modified->format('Y-m-d H:m:s')) ?></p>
    </div>
</div>
