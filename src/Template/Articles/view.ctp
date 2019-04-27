<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<?= $this->Html->css('view.css') ?>
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