<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ArticlesFixture extends TestFixture {

    //テスト用DBの指定とスキーマのインポート
    public $import = ['table' => 'articles', 'connection' => 'test'];

    //datasourceの指定
    //public $connection = 'test';

    /**
     * テスト用テーブルのスキーマ
     * 自動連番のカラムは無視
     * _constraintsにunique keyとかforegn keyとかいれなくていいのか疑問
     */
    /*
    public $fields = [
        'id' => ['type' => 'integer'],
        'title' => ['type' => 'string', 'length' => 255, 'null' => false],
        'body' => ['type' => 'text', 'null' => false],
        'slug' => ['type' => 'string', 'length' => 14, 'null' => false],
        'created' => ['type' => 'datetime'],
        'modified' => ['type' => 'datetime'],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
        ]
    ];*/

    /**
     * テストデータの用意。
     */
    public $records = [
        [
            'title' => 'Test Article',
            'body' => 'これはテスト用の投稿記事です。',
            'slug' => '20190506000005',
            'created' => '2019-05-06 00:00:05',
            'modified' => '2019-05-06 00:00:07'

        ]
    ];
}