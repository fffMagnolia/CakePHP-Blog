<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

class ArticlesTable extends Table {

    public function initialize(array $config) {
        //https://book.cakephp.org/3.0/ja/orm/behaviors/timestamp.html
        $this->addBehavior('Timestamp');
    }

    public function beforeSave($event, $entity, $options) {
        if($entity->isNew() && !$entity->slug) {
            //作成日からスラグを作成
            $slug = Text::slug($entity->created->format('YmdHis'));
            //セット。チュートリアルで行ったようなサイズ調整はしない
            $entity->slug = $slug;
        }
    }

    /**
     * バリデーションを行う
     * title,bodyの空白禁止
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->allowEmptyString('title', false)
            ->allowEmptyString('body', false);

        return $validator;
    }
}