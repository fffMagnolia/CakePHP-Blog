<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="container-fluid">
    <div class="row">
    <table class="table">
        <?php foreach($articles as $article): ?>
        <tr>
            <td><?= $this->Html->link(__(h($article->title)), ['action' => 'view', $article->id]) ?></td>
            <td><?= h($article->created->format('Y-m-d H:m:s')) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
    <div class="row paginator">
        <div class="col-sm-2"></div>
        <div class="col-sm-7 text-center">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
        </div>
        <div class="col-sm-2"></div>
        <!-- <p><?= $this->Paginator->counter(['format' => __('Page {{page}} / {{pages}}, {{current}} / {{count}} Posts')]) ?></p> -->
    </div>
</div>