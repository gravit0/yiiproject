<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update','delete','fakelogin'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create','delete', 'update'],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->user->isGuest) return false;
                            return Yii::$app->user->identity->isPermission(User::PERM_ADMIN);
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['fakelogin'],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->user->isGuest) return false;
                            return Yii::$app->user->identity->isPermission(User::PERM_SUPERUSER);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'create';
        $postarr = Yii::$app->request->post();
        if($postarr) {
        $arr = ArrayHelper::merge($postarr,['User'=>['password' => password_hash($postarr['User']['password'],PASSWORD_DEFAULT)
                ]]);
        if ($model->load($arr) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        }
        return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $postarr = Yii::$app->request->post();
        if($postarr) {
        if ($model->load($postarr) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } }
            return $this->render('update', [
                'model' => $model,
            ]);
    }
    
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionFakelogin($id)
    {
        $model = $this->findModel($id);
        Yii::$app->user->logout();
        Yii::$app->user->login($model, 0);
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
