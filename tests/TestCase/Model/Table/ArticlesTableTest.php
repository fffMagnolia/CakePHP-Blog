<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticlesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class ArticlesTableTest extends TestCase {

    //fixtureのload
    public $fixtures = [ 'app.Articles' ];

    //init
    public function setUp() {
        parent:: setUp();
    }

    /**
     * やりたいこと：
     * テスト記事を作成
     * テスト記事のスラグが作成されることを検証
     */
    public function testBeforeSave() {

    }

    /**
     * やりたいこと
     * title,bodyが空白のテスト記事を投稿
     * 投稿が拒否されリダイレクトされることを検証
     */
    public function testValidationDefault() {

    }
}