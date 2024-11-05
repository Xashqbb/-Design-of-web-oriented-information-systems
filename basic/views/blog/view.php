<?php
use yii\helpers\Html;
?>

<h1><?= Html::encode($post->title) ?></h1>
<p><strong>Дата: </strong><?= Yii::$app->formatter->asDate($post->created_at) ?></p>
<div>
    <?= Html::encode($post->content) ?>
</div>
