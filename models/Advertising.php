<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\captcha\Captcha;

/**
 * This is the model class for table "advertising".
 *
 * @property int $id
 * @property int $userId
 * @property int $status
 * @property string $text
 * @property string $createDate
 * @property string $endDate
 */
class Advertising extends ActiveRecord
{
    public $image; // переменая для картинки
    public $verifyCode;


    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createDate', 'endDate'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public static function tableName()
    {
        return 'advertising';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'status', 'text', 'month'], 'required'],
            [['userId', 'status', 'month'], 'integer'],
            [['text'], 'string'],
            [['createDate', 'endDate'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg, gif, jpeg'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Проверочный код',
            'link' => 'Ссылка на ресурс',
            'status' => 'Статус заявки',
            'text' => 'Описание ресурса',
            'createDate' => 'Дата начала рекламы',
            'endDate' => 'Дата конца рекламы',
            'month' => 'Кол-во месяцев',
            'image' => 'Баннер'
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

    /**
     *
     * Отправка писма "Заявка на рекламу"
     *
     * @return mixed
     */
    public function sendAdvertising()
    {

        $sendingResult = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Заявка на рекламу')
            ->setHtmlBody('<p>Новая заявка на рекламу</p>')
            ->send();

        return $sendingResult;
    }
}
