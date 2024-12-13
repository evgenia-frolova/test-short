<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Link;
use yii\db\Expression;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

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
     * Главная страница
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Link;
        
        if ($model->load(Yii::$app->request->post())){
            $model->short_link = Link::generateShortLink();
            $model->created_at = new Expression('NOW()');
            $model->ip = '';
            
            if ($model->save()) {
                return $this->renderAjax('short', [
                    'link' => $model->link,
                    'shortLink' => $model->short_link,
                ]);
            }
        }
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
    /**
     * @param $short
     * @return \yii\web\Response
     */
    public function actionRedirect()
    {
        $short = Yii::$app->request->post('link');
        
        if (!$short) {
            throw new NotFoundHttpException('Короткая ссылка пустая');
        }
        
        $link = $this->findModelByShort($short);
        $ip = Yii::$app->request->userIP;
        
        if ($link) {
            $link->ip = $ip;
            $link->counter++;
            $link->save();
        }
    }
    
    /**
     * поиск по короткой ссылке
     * @param $short
     * @return Link
     */
    protected function findModelByShort($short)
    {
        if (($model = Link::findByShort($short)) !== null) {
            return $model;
        }
        else {
            throw new NotFoundHttpException('Запрашиваемая ссылка не существует.');
        }    
            
    }
}
