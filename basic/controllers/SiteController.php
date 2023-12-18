<?php

namespace app\controllers;

use app\models\Music;
use app\models\MusicForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDelete($id)
    {
        $model = Music::findOne($id);
        if ($model !== null) {
            $model->delete();
        }
        return $this->redirect(['index']);
    }


    public function actionAdd()
    {
        $model = new MusicForm();

        if ($model->load(Yii::$app->request->post())) {
            $existingModel = Music::findOne(['year' => $model->year, 'executor' => $model->executor, 'album' => $model->album]);
            if ($existingModel !== null) {
                // Если запись с такими значениями уже существует, не выполнять сохранение
                return $this->redirect(['index']);
            } else {
                if ($model->saveToDatabase()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }



}
