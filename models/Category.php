<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function getLesson()
    {
        return $this->hasMany(Category::className(), ['idCategory'=>'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords'], 'required'],
            [['title', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
        ];
    }
}
