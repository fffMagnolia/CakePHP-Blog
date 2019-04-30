<?php
namespace App\Controller;

use App\Controller\AppController;
//画像アップロード処理に必要
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

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
        'limit' => 10,
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
            //記事と作成したユーザのIDを紐付ける
            $article->user_id = $this->Auth->user('id');

            //画像アップロード関連の処理．検証用なのでコメントアウトしている．
            /*
            $dir = realpath(WWW_ROOT."/img");
            $img = $this->request->data['icon'];
            $this->file_upload($article->user_id, $img, $dir);
            */

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('記事が投稿されました．'));
                return $this->redirect(['action' => 'admin']);
            }
            $this->Flash->error(__('記事の投稿に失敗しました．もう一度やり直してください．'));
        }
        $this->set(compact('article'));
        //エラーの場合元のページに戻る
        $this->render('/Admin/admin-add');
    }

    /**
     * 画像アップロード用。add,editから呼ばれる
     * アップロードされた画像は一時ファイルとして保持されている．
     * move_uploaded_file: Upされた一時ファイルが有効な場合，指定のディレクトリに移動&名前変更
     * アイコン画像の命名規則：ユーザID_icon.拡張子
     * 背景画像の命名規則：ユーザID_background.拡張子
     * 検証用のため例外処理がほぼないことに注意
     */
    public function file_upload($id = null, $img = null, $dir = null) {
        $file_name = $id."_icon_".$img['name'];

        $result = move_uploaded_file($img['tmp_name'], "$dir/$file_name");
    }

    public function edit($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData(), 
                ['accessibleFields' => ['user_id' => false]]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('編集した記事を保存しました．'));

                return $this->redirect(['action' => 'admin']);
            }
            $this->Flash->error(__('編集した記事の保存に失敗しました．もう一度やり直してください．'));
        }
        $this->set(compact('article'));
        $this->render('/Admin/admin-edit');
    }

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__("記事が削除されました．"));
        } else {
            $this->Flash->error(__('記事の削除に失敗しました．もう一度やり直してください．'));
        }

        return $this->redirect(['action' => 'admin']);
    }

    /**
     * 管理側のトップページ表示用
     */
    public function admin() {
        //デフォルトのレイアウトをオフにする．ここでオフにすれば指定のCSSファイルのみで設定できる
        //$this->autoLayout = false;

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
