<?php

namespace app\models\userpanel;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Email as EmailModel;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SetemailForm extends Model
{
    public $email;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function setemail()
    {
        if ($this->validate()) {
            $model = Yii::$app->user->identity;
            $model->scenario = 'setemail';
            $link = Yii::$app->security->generateRandomString();
            $this->sendEmail(Yii::$app->request->hostName.'/?r=userpanel%2Fconfirmemail&link='.$link);
            $email = new EmailModel;
            $email->load(['Email'=>['code'=>$link,'email'=>$this->email,'userid'=>$model->id,'type'=>EmailModel::TYPE_SETEMAIL]]);
            $email->save();
            var_dump($email->errors);
            return $model->load(['User'=>['email'=>$this->email]]) && $model->save();
        }
        return false;
    }
    public function sendEmail($link)
    {
        $model = Yii::$app->user->identity;
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom([$model->email])
                ->setSubject("Подтверждение адреса Email")
                ->setTextBody("Кто-то решил сменить свой EMail адрес ".$model->email." на ваш. Если это были Вы - все в порядке.<br><a href='$link'>Подтверждить Email</a>")
                ->send();
            return true;
        }
        return false;
    }
    
}
