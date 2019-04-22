<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="articles index large-9 medium-8 columns content">
    <?= $this->Html->image('1_icon_test.jpg', ['alt' => 'success!']); ?>
    <p><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></p>
    <table class="vertical-table">
       <tr>
            <th>Title</th>
            <th>Created</th>
       </tr>
       <?php foreach($articles as $article): ?>
        <tr>
            <td><?= $this->Html->link(__(h($article->title)), ['action' => 'view', $article->id]) ?></td>
            <!-- DateTimeの書式 -->
            <td><?= h($article->created->format('Y-m-d H:m:s')) ?></td>
            <td><?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?></td>
            <td><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __("タイトル:{$article->title}を削除しますか?", $article->id)]) ?></td>
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
