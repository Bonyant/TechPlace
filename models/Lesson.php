<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property int $id
 * @property int $idCategory
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property int $lesson
 * @property string $text
 * @property string $video
 * @property int $views
 */
class Lesson extends \yii\db\ActiveRecord
{

    public $image;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id'=>'idCategory']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCategory', 'title', 'keywords', 'description', 'text', 'video'], 'required'],
            [['idCategory', 'lesson', 'views'], 'integer'],
            [['text', 'video'], 'string'],
            [['title', 'keywords', 'description'], 'string', 'max' => 255],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'idCategory' => 'Категория',
            'title' => 'Название поста',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание',
            'lesson' => '№ поста',
            'text' => 'Описание поста',
            'video' => 'Видео',
            'views' => 'Количество просмотров',
            'image' => 'Картинка',
            'date' => 'Дата публикации'
        ];
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }
}
