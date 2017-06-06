<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->login;
$this->params['breadcrumbs'][] = 'Личный кабинет';
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?>(Вы)</h1>

    <p>
        <?= Html::a('Смена пароля', ['setpassword'], ['class' => 'btn btn-primary']);?>
        <?= Html::a('Смена EMail', ['setemail'], ['class' => 'btn btn-primary']);?>
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
