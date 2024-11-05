<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<h1>Блог</h1>
<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <h2>
                <?= Html::encode($post->title) ?>
            </h2>
            <p>
                <?= Html::encode($post->excerpt) ?> <!-- Виводимо анонс, якщо є -->
            </p>
            <p>
                <a href="<?= yii\helpers\Url::to(['blog/view', 'id' => $post->id]) ?>">Читати далі</a>
            </p>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Додати пагінацію -->
<?= LinkPager::widget([
    'pagination' => $pagination,
]) ?>
