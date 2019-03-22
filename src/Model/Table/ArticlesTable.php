<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;

class ArticlesTable extends Table {
    public function initialize(array $config) {
        //https://book.cakephp.org/3.0/ja/orm/behaviors/timestamp.html
        $this->addBehavior('Timestamp');
    }

    public function beforeSave($event, $entity, $options) {
        if($entity->isNew() && !$entity->slug) {
            //作成日からスラグを作成
            $slug = Text::slug($entity->created->format('YmdHis'));
            //セット。サンプルで行ったようなサイズ調整はしない
            $entity->slug = $slug;
        }
    }
}