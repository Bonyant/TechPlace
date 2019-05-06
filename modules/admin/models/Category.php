<?php

namespace app\modules\admin\models;

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

    /**
     *
     * Связь категории с уроками
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasMany(Lesson::className(),['idCategory' => 'id'] );
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
            'title' => 'Название категории',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
        ];
    }
}
