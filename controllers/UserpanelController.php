<?php

namespace app\controllers;
use yii\filters\AccessControl;
use app\models\User;
use app\models\userpanel\SetpasswordForm;
use app\models\userpanel\SetemailForm;
use Yii;

class UserpanelController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]];
    }
    public function actionIndex()
    {
        return $this->render('index',[
            'model' => Yii::$app->user->identity,
        ]);
    }
    public function actionSetemail()
    {
        $model = new SetemailForm;
        $postarr = Yii::$app->request->post();
        if($postarr) {
            $model->load($postarr);
            $model->setemail();
        }
        return $this->render('setemail',[
            'model' => new SetemailForm,
        ]);
    }
    public function actionSetpassword()
    {
        $model = new SetpasswordForm;
        $postarr = Yii::$app->request->post();
        if($postarr) {
            $model->load($postarr);
            $model->setpassword();
        }
        return $this->render('setpassword',[
            'model' => new SetpasswordForm,
        ]);
    }
}
