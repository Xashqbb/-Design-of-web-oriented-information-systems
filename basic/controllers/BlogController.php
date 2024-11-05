<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Post;

class BlogController extends Controller
{
    public function actionIndex()
    {

        $pageSize = 10;


        $query = Post::find()->orderBy('created_at ASC');

        // створити об'єкт пагінації
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count(),
        ]);


        $posts = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->render('index', [
            'posts' => $posts,
            'pagination' => $pagination,  // передаємо пагінацію
        ]);
    }

    public function actionView($id)
    {
        $post = Post::findOne($id);

        if ($post) {
            return $this->render('view', [
                'post' => $post,
            ]);
        }

        throw new \yii\web\NotFoundHttpException('Запис не знайдено.');
    }
}

class BlogControllerTest extends Unit
{
    protected $controller;

    protected function _before()
    {
        // Ініціалізація контролера перед кожним тестом
        $this->controller = new BlogController('blog', Yii::$app);
    }

    public function testIndexReturnsViewWithPosts()
    {
        // Додаємо кілька фіктивних постів у базу даних
        $this->createTestPosts(5);

        // Викликаємо метод actionIndex
        $response = $this->controller->actionIndex();

        // Перевіряємо, що відповідь не є null
        $this->assertNotNull($response);

        // Перевіряємо, що в рендеринговій відповіді є пости
        $posts = $this->controller->view->params['posts'];
        $this->assertCount(5, $posts); // Перевіряємо, що 5 постів
    }

    protected function createTestPosts($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $post = new Post();
            $post->title = 'Test Post ' . $i;
            $post->content = 'Content for test post ' . $i;
            $post->excerpt = 'Excerpt for test post ' . $i;
            $post->created_at = date('Y-m-d H:i:s', strtotime("-$i days"));
            $post->save();
        }
    }
}