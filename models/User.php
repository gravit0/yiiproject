<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    
    public static function tableName()
    {
        return 'users';
    }
    const PERM_COMMENT = 1 << 1;
    const PERM_ADMIN = 1 << 2;
    const PERM_SUPERUSER = 1 << 3;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login'], 'required'],
            [['login', 'password', 'email', 'auth_key', 'access_token'], 'string'],
            [['permissions', 'flags'], 'integer'],
            [['email'], 'email'],
            [['last_login'], 'safe'],
        ];
    }
    public function getGroupMap()
    {
        return [
            User::PERM_COMMENT => 'Комментатор',
            User::PERM_ADMIN => 'Администратор',
            User::PERM_SUPERUSER => 'Суперпользователь',
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'permissions' => 'Привилегии',
            'flags' => 'Флаги',
            'last_login' => 'Последний вход',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }
    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }
    public function scenarios()
    {
        $scenarios['update'] = ['login', 'email', '!password'];
        $scenarios['setpassword'] = ['password'];
        $scenarios['setperm'] = ['permissions'];
        $scenarios['setemail'] = ['email'];
        $scenarios['create'] = ['login', 'email', 'password']; 
        $scenarios['default'] = [];
        return $scenarios;
    }
    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function validatePassword($password)
    {
        return password_verify($password,$this->password);
    }
    
    function isPermission($perm)
    {
        return $this->permissions & $perm;
    }
    function addPermission($group)
    {
        $this->permissions = $this->permissions | $group;
    }
    function rmPermission($group)
    {
        $this->permissions = $this->permissions ^ $group;
    }
    function isFlag($flag)
    {
        return $this->flags & $flag;
    }
    function addFlag($group)
    {
        $this->flags = $this->flags | $group;
    }
    function rmFlag($group)
    {
        $this->flags = $this->flags ^ $group;
    }
}
