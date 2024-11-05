<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;  // Додати імпорт LinkPager
?>

<h1>Країни</h1>
<ul>
    <?php foreach ($countries as $country): ?>
        <li>
            <?= Html::encode("{$country->name} ({$country->code})") ?>:
            <?= $country->population ?>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Додати пагінацію -->
<?= LinkPager::widget([
    'pagination' => $pagination,  // Передаємо пагінацію
]) ?>
