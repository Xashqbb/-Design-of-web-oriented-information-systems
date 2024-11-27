<?php

use app\models\Article;
use Codeception\Test\Unit;
use yii\helpers\Url;

class ArticleTest extends Unit
{
    // Тест для створення статті
    public function testCreateArticle()
    {
        $articleData = [
            'title' => 'Test Article',
            'content' => 'This is a test article content.',
            'image' => null,  // Якщо зображення не тестується
        ];

        $article = new Article();
        $article->setAttributes($articleData);

        // Перевірка, чи модель проходить валідацію та зберігається в базі даних
        $this->assertTrue($article->save(), 'Failed to save the article');
        $this->assertNotNull($article->id, 'Article ID should not be null');
    }

    // Тест для перегляду статті
    public function testViewArticle()
    {
        // Створення статті для тестування перегляду
        $article = Article::findOne(['title' => 'Test Article']);
        $this->assertNotNull($article, 'Article should exist in the database');

        // Використовуємо URL для перегляду статті
        $url = Url::to(['article/view', 'id' => $article->id]);
        $this->tester->amOnPage($url);
        $this->tester->see('Test Article');
        $this->tester->see('This is a test article content.');
    }

    // Тест для оновлення статті
    public function testUpdateArticle()
    {
        // Створення статті для тестування оновлення
        $article = Article::findOne(['title' => 'Test Article']);
        $this->assertNotNull($article, 'Article should exist in the database');

        // Оновлюємо заголовок статті
        $article->title = 'Updated Test Article';
        $this->assertTrue($article->save(), 'Failed to update the article');

        // Перевіряємо, чи оновлений заголовок статті
        $updatedArticle = Article::findOne($article->id);
        $this->assertEquals('Updated Test Article', $updatedArticle->title, 'Article title was not updated');
    }

    // Тест для видалення статті
    public function testDeleteArticle()
    {
        // Створення статті для тестування видалення
        $article = Article::findOne(['title' => 'Updated Test Article']);
        $this->assertNotNull($article, 'Article should exist in the database');

        // Видаляємо статтю
        $articleId = $article->id;
        $article->delete();

        // Перевірка, чи стаття була видалена
        $deletedArticle = Article::findOne($articleId);
        $this->assertNull($deletedArticle, 'Article was not deleted');
    }
}
