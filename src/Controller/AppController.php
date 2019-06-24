<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

        /**
         * 認証用のコンポーネントを読み込む
         */
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'autorize' => ['Controller'],
            'unauthorizedRedirect' => $this->referer(),
            'authError' => 'この機能の使用にはログインが必要です',
            'flash' => [
                'key' => 'auth',
                'element' => 'error'
            ]
        ]);
        
        //閲覧だけ可能なようにする
        $this->Auth->allow(['display', 'view', 'index', 'archive']);

        /** 
         * サイドバーの機能はここで実装。全アクションの共通処理とする
         * BUG:$this->...だとUsersControllerが対象になったりするので改善する
        */
        $archives = $this->getArchives();
        $this->set(compact('archives'));
    }

    /**
      * 認証後許可するアクションを指定
      * 全てのアクションを許可する
    */
    public function isAuthorized() {
        return true;
    }

    /**
     * MySQLとPostgresではクエリが微妙に違う
     * 下記はMySQLに対応したもの
     */
    /*
    public function getArchives() {
        $this->loadModel('Articles');
        $query = $this->Articles->find();
        //NOTE: MySQLとPostgresでは日付の扱い方が異なることに注意
        $count = $query->func()->count('id');
        $archives = $query->select(['year' => 'YEAR(created)', 'month' => 'MONTH(created)', 'count' => $count])
            ->distinct(['year', 'month'])
            //NOTE:もっといい方法はないものか
            ->order(['year' => 'DESC'])
            ->order(['month' => 'DESC']);

        return $archives;
    }
    */
    /**
     * 下記はPostgreSQLに対応したもの
     */
    public function getArchives() {
        $this->loadModel('Articles');
        $query = $this->Articles->find();
        //NOTE: MySQLとPostgresでは日付の扱い方が異なることに注意
        $count_query = $query->func()->count('*');
        $year_query = $query->func()->extract('year', 'created');
        $month_query = $query->func()->extract('month' ,'created');
        $archives = $query->select(['year' => $year_query, 'month' => $month_query, 'count' => $count_query])
            //NOTE:意味的にはDISTINCTの方が正しいのでそちらを使いたい
            ->group(['year', 'month'])
            //NOTE:もっといい方法はないものか
            ->order(['year' => 'DESC'])
            ->order(['month' => 'DESC']);

        return $archives;
    }

}
