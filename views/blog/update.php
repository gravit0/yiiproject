<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */

$this->title = 'Редактировать запись: "' . $model->header.'"';
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->header, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="blog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
