<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;  // Додати імпорт класу Pagination
use app\models\Country;

class CountryController extends Controller
{
    public function actionIndex()
    {
        // кількість елементів на сторінці
        $pageSize = 5;

        // отримати загальну кількість країн
        $query = Country::find()->orderBy('name');

        // створити об'єкт пагінації
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count(),
        ]);

        // отримати країни для поточної сторінки
        $countries = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        // передати пагінацію та країни в представлення
        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,  // передаємо пагінацію
        ]);
    }

    public function actionUpdate($id)
    {
        // отримати рядок, по основному ключу
        $country = Country::findOne($id);
        if ($country) {
            // змінити назву країни на "U.S.A." і зберегти в БД
            $country->name = 'U.S.A.';
            $country->save();
        }
        return $this->redirect(['index']);
    }
}
