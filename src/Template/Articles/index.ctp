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
    <!-- BootstrapUIのPaginatorはfirst/lastが実装されていないのでCakePHPのを使用 -->
    <div class="row paginator">
        <div class="col-sm-2"></div>
        <div class="col-sm-7 text-center">
            <ul class="pagination">
                <!--<?= $this->Paginator->first('<< ' . __('最初')) ?>-->
                <?= $this->Paginator->first('<< ') ?>
                <?= $this->Paginator->prev('< ') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(' >') ?>
                <?= $this->Paginator->last(' >>') ?>
            </ul>
        </div>
        <div class="col-sm-2"></div>
        <!-- <p><?= $this->Paginator->counter(['format' => __('Page {{page}} / {{pages}}, {{current}} / {{count}} Posts')]) ?></p> -->
    </div>
</div>