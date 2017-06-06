<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */

$this->title = $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        if (!Yii::$app->user->isGuest) {
        echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        echo ' ';
        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]);
        }?>
    </p>
    <?= Html::encode($model->text) ?>

</div>
