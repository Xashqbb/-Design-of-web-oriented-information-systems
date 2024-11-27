<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'signup-form']);

echo $form->field($model, 'username');
echo $form->field($model, 'password')->passwordInput();

echo Html::submitButton('Signup', ['class' => 'btn btn-primary']);

ActiveForm::end();
?>
