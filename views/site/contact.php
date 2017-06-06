<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.
        </div>

        <p>
            Обратите внимание: если вы включите отладчик Yii, вы сможете просматривать почтовое сообщение в почтовой панели отладчика.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Поскольку приложение находится в режиме разработки, сообщение не отправляется, а сохраняется как файл в <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Пожалуйста, настройте свойство <code>useFileTransport</code> компонента <code>mail</code>
                как false для включения отправки электронной почты.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            Если у вас есть деловые вопросы или другие вопросы, заполните следующую форму, чтобы связаться с нами.
             Спасибо.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name',['labelOptions'=>['label'=> 'Имя']])->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email',['labelOptions'=>['label'=> 'EMail']]) ?>

                    <?= $form->field($model, 'subject',['labelOptions'=>['label'=> 'Субъект']]) ?>

                    <?= $form->field($model, 'body',['labelOptions'=>['label'=> 'Сообщение']])->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Проверить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
