<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Article;
use yii\web\Controller;
use yii\web\UploadedFile;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Article::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested article does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Article();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Article saved successfully.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save article.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Failed to upload image.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = Article::findOne($id);
        if ($model === null) {
            throw new \yii\web\NotFoundHttpException('The requested article does not exist.');
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

}
