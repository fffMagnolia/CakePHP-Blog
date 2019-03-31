<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Archives') ?></li>
        <?php foreach($archives as $archive): ?>
            <?php $link = "{$archive->year}/{$archive->month}({$archive->count})"; ?>
            <li><?= $this->Html->link(__(h($link)), ['action' => 'archive']) ?></li>
        <?php endforeach; ?>
    </ul>
</nav>
<div class="articles index large-9 medium-8 columns content">
    <h3>EE</h3>
    <p><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></p>
    <table class="vertical-table">
        <tr><th>Title</th><th>Created</th></tr>
        <?php foreach($articles as $article): ?>
        <tr>
            <td><?= $this->Html->link(__(h($article->title)), ['action' => 'view', $article->id]) ?></td>
            <td><?= h($article->created->format('y-m-d H:m:s')) ?></td>
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
