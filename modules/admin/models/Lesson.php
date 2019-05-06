<?php

namespace app\modules\admin\models;

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

    /**
     *
     * Связь Урока с категорией
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id' => 'idCategory'] );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCategory', 'title', 'keywords', 'description', 'lesson', 'text', 'video'], 'required'],
            [['idCategory', 'lesson', 'views'], 'integer'],
            [['text', 'video'], 'string'],
            [['title', 'description', 'keywords'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
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
            'date' => 'Дата публикации',
        ];
    }

    /**
     *
     * Загружаем картинку
     *
     * @return bool
     */
    public function upload()
    {
        if ($this->validate())
        {
            $path = 'images/store' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        }
        else
        {
           return false;
        }
    }
}
