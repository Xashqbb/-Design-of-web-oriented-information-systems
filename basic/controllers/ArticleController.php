<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Article models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            // Завантажуємо файл, якщо він є
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->image) {
                // Генерація унікального імені файлу та шляху
                $imagePath = 'uploads/' . uniqid() . '.' . $model->image->extension;
                $fullPath = Yii::getAlias('@app') . '/web/' . $imagePath; // Папка web/uploads

                // Спробуємо зберегти файл
                if ($model->image->saveAs($fullPath)) {
                    $model->image = $imagePath; // Зберігаємо шлях до файлу в моделі
                } else {
                    Yii::error('Error saving image: ' . $fullPath, __METHOD__);
                    Yii::$app->session->setFlash('error', 'Error saving image');
                }
            }

            // Зберігаємо модель в базу даних
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Article created successfully');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::error('Error saving model: ' . json_encode($model->errors), __METHOD__);
                Yii::$app->session->setFlash('error', 'Error saving article');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            // Отримуємо файл з форми
            $imageFile = UploadedFile::getInstance($model, 'image');

            if ($imageFile) {
                // Генерація унікального шляху для збереження файлу
                $imagePath = 'uploads/' . uniqid() . '.' . $imageFile->extension;

                // Спробуємо зберегти файл у папку 'web/uploads'
                if ($imageFile->saveAs(Yii::getAlias('@webroot') . '/' . $imagePath)) {
                    // Якщо файл збережено, записуємо шлях до нього в модель
                    $model->image = $imagePath;
                } else {
                    Yii::error('Не вдалося зберегти зображення: ' . $imagePath, __METHOD__);
                    Yii::$app->session->setFlash('error', 'Помилка при збереженні зображення');
                }
            }

            // Якщо файл не вибрано, зберігаємо старе значення image
            if (!$imageFile && !$model->image) {
                $model->image = $model->getOldAttribute('image');
            }

            // Збереження оновленої моделі
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Статтю оновлено');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::error('Помилка збереження моделі: ' . json_encode($model->errors), __METHOD__);
                Yii::$app->session->setFlash('error', 'Помилка при оновленні статті');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Article deleted successfully');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
