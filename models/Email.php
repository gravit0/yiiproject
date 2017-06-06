<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property integer $id
 * @property string $code
 * @property integer $type
 * @property integer $userid
 * @property string $info
 * @property string $email
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email';
    }
    
    const TYPE_SETEMAIL = 1;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'type', 'userid', 'email'], 'required'],
            [['code', 'info', 'email'], 'string'],
            [['type', 'userid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'type' => 'Type',
            'userid' => 'Userid',
            'info' => 'Info',
            'email' => 'Email',
        ];
    }
}
