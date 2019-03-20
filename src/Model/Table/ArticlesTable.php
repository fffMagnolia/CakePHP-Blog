<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table {
    public function initialize(array $config) {
        //https://book.cakephp.org/3.0/ja/orm/behaviors/timestamp.html
        $this->addBehavior('Timestamp');
    }
}