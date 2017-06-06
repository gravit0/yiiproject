<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $category
 * @property string $header
 * @property string $brieftext
 * @property string $text
 * @property integer $rating
 * @property integer $visible
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'header', 'brieftext', 'text'], 'required'],
            [['id_user', 'category', 'rating', 'visible'], 'integer'],
            [['brieftext', 'text'], 'string'],
            [['header'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Автор',
            'category' => 'Категория',
            'header' => 'Заголовок',
            'brieftext' => 'Краткий текст',
            'text' => 'Текст',
            'rating' => 'Рейтинг',
            'visible' => 'Видимость',
        ];
    }
}
