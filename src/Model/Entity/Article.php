<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity {
    //https://book.cakephp.org/3.0/ja/orm/entities.html#entities-mass-assignment
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}