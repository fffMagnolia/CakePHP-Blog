<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * compact(): 引数を連想配列にしてくれるので、変数をまとめてビューに渡せる
 */
class ArticlesController extends AppController {

    //===== 閲覧側・管理側共通 =====
    /**
     * 記事表示用。指定された記事のデータを返す
     */
    public function getArticle($id) {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);

        return $article;
    }

    /**
     * ページネーションの設定
     */
    public $paginate = [
        'limit' => 3,
        'order' => [ 'Articles.created' => 'desc']
    ];

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    //===== 閲覧側 =====
    public function index() {
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    public function view($id = null) {
        $article = $this->getArticle($id);

        $this->set(compact('article'));
    }

    //===== 管理側 =====
    public function add() {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            //仮置きユーザID
            $article->user_id = 1;
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'admin']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article'));
        $this->render('/Admin/admin-add');


    }

    public function edit($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article'));
        $this->render('/Admin/admin-edit');
    }

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * 管理側のトップページ表示用
     */
    public function admin() {
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
        $this->render('/Admin/admin-index');
    }

    public function adminView($id = null) {
        $article = $this->getArticle($id);

        $this->set(compact('article'));
        $this->render('/Admin/admin-view');
    }

    //arhiveリンク作成用。default.ctpから呼ばれている
    public function archive($year, $month) {
        //問い合わせる日付の作成
        $date = date("Y-m", mktime(0, 0, 0, $month, 1, $year));

        $query = $this->Articles->find();
        //選択されたリンクの年月日に該当する記事を取得
        $articles = $query->select()
            ->where(['created LIKE' => "{$date}%"])
            ->order(['id' => 'DESC']);
        $articles = $this->paginate($articles);

        $this->set(compact('articles'));
        $this->render('/Archive/archive-view');
    }
}
