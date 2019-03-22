<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articles index large-9 medium-8 columns content">
    <h3>EE</h3>
    <!-- 記事タイトル（スペース）作成日時　の形式でリスト表示 -->
    <table class="vertical-table">
        <?php foreach($articles as $article): ?>
        <tr>
            <td><?= h($article->title) ?></td>
            <!-- DateTimeの書式 -->
            <td><?= h($article->created->format('Y-m-d H:i:s')) ?></td>
            <td><?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?></td>
            <td><?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?></td>
            <td><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <!-- <p><?= $this->Paginator->counter(['format' => __('Page {{page}} / {{pages}}, {{current}} / {{count}} Posts')]) ?></p> -->
    </div>
</div>
