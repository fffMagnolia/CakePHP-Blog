<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{

    //===== 閲覧側・管理側共通 =====
    /**
     * 記事表示用。指定された記事のデータを返す
     */
    public function getArticle($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);

        return $article;
    }

    /**
     * アーカイブリンク作成用。下記のクエリをクエリビルダーで作成
     * SELECT DISTINCT MONTH(created) AS month, YEAR(created) AS year, count(id) AS post_count FROM articles GROUP BY year, month ORDER BY year, month;
     * NOTE:$countは改良の余地アリ
     */
    public function setArchives() {
        $query = $this->Articles->find();
        $count = $query->func()->count('id');
        $archives = $query->select(['year' => 'YEAR(created)', 'month' => 'MONTH(created)', 'count' => $count])
            ->distinct(['year', 'month'])
            ->order(['count' => 'DESC']);

        return $archives;
    }

    //===== 閲覧側 =====
    public function index() {
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    public function view() {
        $article = getArticle();

        $this->set('article', $article);
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

    public function admin() {
        //記事表示部分
        $articles = $this->paginate($this->Articles);        
        //一度全データを取得する
        //↑とどう違う？
        $query = $this->Articles->find();
        //count関数を準備
        $count = $query->func()->count('id');
        //クエリビルダーでクエリの作成。↓のクエリになる
        //SELECT DISTINCT MONTH(created) AS month, YEAR(created) AS year, count(id) AS post_count FROM articles GROUP BY year, month ORDER BY year, month;
        $archives = $query->select(['year' => 'YEAR(created)', 'month' => 'MONTH(created)', 'count' => $count])
            ->distinct(['year', 'month'])
            ->order(['count' => 'DESC']);
        //セット
        $this->set(compact('archives'));
        //記事表示用にセット→遷移
        $this->set(compact('articles'));
        $this->render('/Admin/admin-index');
    }



    public function adminView() {
        $article = getArticle();

        $this->set('article', $article);
        $this->render('/Admin/admin-view');
    }

    public function archive() {
        //arhive表示用
    }
}
