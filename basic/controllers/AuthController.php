<?php
namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        // Завантажуємо дані з форми і намагаємося зареєструвати користувача
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Дякуємо за реєстрацію. Тепер ви можете увійти.');
            return $this->redirect(['login']);
        }

        // Показуємо форму реєстрації, якщо дані ще не були передані або є помилки валідації
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
