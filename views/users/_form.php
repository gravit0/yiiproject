<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$model->password = '';
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'login',['labelOptions'=>['label'=> 'Логин']])->input('text') ?>
    <?php    if (!$nopassword) {
        echo $form->field($model, 'password', ['labelOptions' => ['label' => 'Пароль']])->passwordInput();
    }
    ?>

    <?= $form->field($model, 'email')->input('text') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
