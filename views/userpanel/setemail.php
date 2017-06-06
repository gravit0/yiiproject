<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Смена пароля '.Yii::$app->user->identity->login;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Смена EMail';
?>
<div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                
                    <?= $form->field($model, 'email',['labelOptions'=>['label'=> 'Новый EMail']])->textInput(['autofocus' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Сменить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
                <p>На этот EMail придет подтверждение с ссылкой, по которой нужно перейти</p>
            </div>
</div>
