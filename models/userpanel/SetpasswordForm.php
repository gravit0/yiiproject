<?php

namespace app\models\userpanel;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SetpasswordForm extends Model
{
    public $password;
    public $newpassword;
    public $newpassword2;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password','newpassword','newpassword2'], 'required'],
            [['password'], 'validatePassword'],
            [['newpassword'], 'validatePassword2'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function setpassword()
    {
        if ($this->validate()) {
            $model = Yii::$app->user->identity;
            $model->scenario = 'setpassword';
            $this->newpassword = password_hash($this->newpassword,PASSWORD_DEFAULT);
            return $model->load(['User'=>['password'=>$this->newpassword]]) && $model->save();
        }
        return false;
    }
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = Yii::$app->user->identity;
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect oldpassword.');
            }
        }
    }
    public function validatePassword2($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->newpassword != $this->newpassword2) {
                $this->addError($attribute, 'Incorrect newpassword or newpassword2.');
            }
        }
    }
}
