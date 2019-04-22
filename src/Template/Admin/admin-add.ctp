<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="articles form large-9 medium-8 columns content">
    <p><?= $this->Html->link(__('←Return Admin Top'), ['action' => 'admin']) ?></p>
    <!-- 複数のMIMEタイプを扱うためmultipart...を指定-->
    <?= $this->Form->create($article, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('body');
            //NOTE:ここにサムネイル欲しい
            echo $this->Form->file('icon');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
