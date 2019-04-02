<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="articles view large-9 medium-8 columns content">
    <h3><?= $this->Html->link(__('EE'), ['action' => 'index']) ?></h3>
    <p><b><?= h($article->title) ?></b></p>
    <div class="row">
        <?= $this->Text->autoParagraph(h($article->body)); ?>
    </div>
            <p>最終更新日： <?= h($article->modified->format('Y-m-d H:m:s')) ?></p>
    </table>
</div>