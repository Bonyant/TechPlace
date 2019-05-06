<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $id_lesson
 * @property string $user_name
 * @property string $text
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'id_lesson', 'user_name', 'text'], 'required'],
            [['parent_id', 'id_lesson'], 'integer'],
            [['text'], 'string'],
            [['user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => 'КОММЕНТАРИЙ',
        ];
    }
}
