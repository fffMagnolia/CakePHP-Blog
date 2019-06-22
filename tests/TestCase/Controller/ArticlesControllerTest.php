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
     * Test add method
     */
    public function testAdd()
    {
        //認証作業
        $user_name = env('USER_NAME');
        $password = env('PASSWORD');
        $this->session([
            'Auth' => ['User' => ['id' => 1, 'username' => "{$user_name}", 'password' => "{$password}"] ]
        ]);
        
        $this->get('/articles/add/');
        //無事アクセスできたらOK
        $this->assertResponseOK();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
