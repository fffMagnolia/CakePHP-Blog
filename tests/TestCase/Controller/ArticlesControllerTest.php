<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ArticlesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ArticlesController Test Case
 */
class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    /*public $fixtures = [
        'app.Articles'
    ];*/

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testView()
    {
        //IDを指定しなかった場合
        $this->get('/articles/view/');
        $this->assertResponseError();

        //存在しないIDを指定した場合
        $this->get('/articles/view/9999/');
        $this->assertResponseError();

        //存在するIDを指定した場合
        $this->get('/articles/view/1');
        $this->assertResponseOk();
    }

    /**
     * 認証を通過しなかった場合リダイレクトされること
     */
    public function testAddUnAuthenticatedFails(){
        $this->get('/articles/add');
        //リダイレクトした場合は末尾にクエリがつくので一部をチェック
        $this->assertRedirectContains('/users/login');
    }

    /**
     * 認証を通過した場合のみアクセスできること→OK!
     * 認証が通過しなかった場合リダイレクトすること->OK!
     * 記事を追加できること
     * 不正な形式の記事が追加できないこと
     */
    public function testAddAuthenticated() {
        //認証作業
        $user_name = env('USER_NAME');
        $password = env('PASSWORD');
        $this->session([
            'Auth' => ['User' => ['id' => 1, 'username' => "{$user_name}", 'password' => "{$password}"] ]
        ]);
        
        $this->get('/articles/add/');
        //無事アクセスできたらOK
        $this->assertResponseOk();
    }

    public function testEditUnAuthenticatedFails() {
        //2019.6.22現在一番古い記事を参照している
        $this->get('/articles/edit/3');
        //ログインページにリダイレクトしたらOK
        $this->assertRedirectContains('/users/login');
    }

    /**
     * 認証が通った場合アクセスできること→OK!
     * 認証に失敗した場合リダイレクトすること->OK!
     * 記事の編集後保存できること
     * 不正な形式の記事を保存できないこと
     */
    public function testEditAuthenticated () {
        //認証作業
        $user_name = env('USER_NAME');
        $password = env('PASSWORD');
        $this->session([
            'Auth' => ['User' => ['id' => 1, 'username' => "{$user_name}", 'password' => "{$password}"] ]
        ]);

        //2019.6.22現在一番古い記事を参照している
        $this->get('/articles/edit/3');
        $this->assertResponseOk();
    }

    public function testDeleteUnAuthenticatedFails() {
        //2019.6.22現在一番新しい記事を参照している
        $this->get('/articles/delete/12');
        //リダイレクトしたらOK
        $this->assertRedirectContains('/users/login');
    }

    /**
     * 認証が通過した場合ダイアログが表示されること
     * ダイアログ表示後OK押下で記事が削除できること
     * 認証で通過しなかった場合リダイレクトされること→OK!
     * ダイアログでCancel押下時に記事が削除されないこと
     */
    public function testDelete()
    {
        //認証作業
        $user_name = env('USER_NAME');
        $password = env('PASSWORD');
        $this->session([
            'Auth' => ['User' => ['id' => 1, 'username' => "{$user_name}", 'password' => "{$password}"] ]
        ]);

        //TODO:ここでダイアログがでることを確認したい
        
        $this->assertResponseSuccess();
    }
}
