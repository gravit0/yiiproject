<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Смена пароля '.Yii::$app->user->identity->login;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Смена пароля';
$model->password = '';
?>
<div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                
                    <?= $form->field($model, 'password',['labelOptions'=>['label'=> 'Старый Пароль']])->passwordInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'newpassword',['labelOptions'=>['label'=> 'Новый Пароль']])->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'newpassword2',['labelOptions'=>['label'=> 'Новый Пароль(повторите)']])->textInput(['autofocus' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Сменить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
</div>
