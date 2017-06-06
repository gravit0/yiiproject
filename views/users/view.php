<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->isPermission(User::PERM_ADMIN)) {
                echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            }
        }
        ?>
        <?php
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->isPermission(User::PERM_SUPERUSER)) {
                echo Html::a('Войти', ['fakelogin', 'id' => $model->id], ['class' => 'btn btn-primary'
                    ,'data' => [
                'confirm' => 'Вы действительно хотите войти под этим пользователем?',
                'method' => 'post',
            ],]);
            }
        }
        ?>
        <?php
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->isPermission(User::PERM_SUPERUSER)) {
                echo Html::a('Привилегии', ['adminpanel/showperm', 'id' => $model->id], ['class' => 'btn btn-primary'
                    ]);
            }
        }
        ?>
        <?php
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->isPermission(User::PERM_ADMIN)) {
                echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этого пользователя?',
                'method' => 'post',
            ],
        ]);
            }
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login:ntext',
            'email:ntext',
            'last_login',
        ],
    ]) ?>
    <p><b>Группы:</b></p>
    <?php
    $groupmap = User::getGroupMap();
    foreach ($groupmap as $k=>$v) {
        if ($model->isPermission($k)) {
            echo '<div class="btn btn-primary">' . $v . '</div> ';
        }
} ?>

</div>
