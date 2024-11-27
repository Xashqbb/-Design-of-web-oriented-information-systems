<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\DynamicModel;

/* @var $this yii\web\View */
/* @var $model DynamicModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Entry Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-entry">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Fill out the form below to proceed:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'entry-form',
        'action' => ['site/entry'],
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'entry-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
