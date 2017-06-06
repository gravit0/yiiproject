<?php

namespace app\controllers;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class AdminpanelController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->user->isGuest) return false;
                            return Yii::$app->user->identity->isPermission(User::PERM_ADMIN);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'addperm' => ['POST'],
                    'rmperm' => ['POST'],
                ],
            ],
        ];
    }
    public function actionAddperm($id,$perm)
    {
        $user = Yii::$app->user->identity;
        if (($perm === User::PERM_SUPERUSER) && !$user->isPermission(User::PERM_SUPERUSER)) {
            throw new \yii\web\ForbiddenHttpException;
        }
        $model = User::findOne($id);
        $model->scenario = 'setperm';
        $model->addPermission($perm);
        $model->save();
        return $this->redirect(['showperm','id'=>$id]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRmperm($id,$perm)
    {
        $user = Yii::$app->user->identity;
        if (($perm === User::PERM_SUPERUSER) && !$user->isPermission(User::PERM_SUPERUSER)) {
            throw new \yii\web\ForbiddenHttpException;
        }
        $model = User::findOne($id);
        $model->scenario = 'setperm';
        $model->rmPermission($perm);
        $model->save();
        return $this->redirect(['showperm','id'=>$id]);
    }

    public function actionShowperm($id)
    {
        $model = User::findOne($id);
        return $this->render('showperm',['model'=>$model]);
    }

}
