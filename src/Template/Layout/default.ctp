<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'EE';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <!-- 基本のCSS -->
    <?= $this->Html->css('base.css') ?>
    <!-- Bootstrapの追加 -->
    <?= $this->Html->css('bootstrap/bootstrap.css') ?>
    <?= $this->Html->script(['jquery/jquery.js', 'bootstrap/bootstrap.js']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <h1 class="title-area">
                <?= $this->Html->link(__('Exception/Expression'), ['controller' => 'articles', 'action' => 'index']) ?>
                <!--<?= $this->Html->image('1_icon_test.jpg', ['alt' => 'success!']); ?>-->
            </h1>
        </div>
        <div class="row">
            <nav class="side-bar col-sm-3">
                <p><?= __('アーカイブ') ?></p>
                <ul class="archive-list list-unstyled">
                    <?php foreach($archives as $archive): ?>
                        <?php $link = "{$archive->year}/{$archive->month}({$archive->count})"; ?>
                        <li><?= $this->Html->link(__(h($link)), ['controller' => 'articles', 'action' => 'archive', $archive->year, $archive->month]) ?></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <?= $this->Flash->render() ?>
            <div class="col-sm-8">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-2"></div>
            <footer class="col-sm-3 text-center">Powered by CakePHP</footer>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
</html>
