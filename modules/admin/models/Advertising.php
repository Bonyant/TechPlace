<?php

namespace app\modules\admin\models;

use app\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "advertising".
 *
 * @property int $id
 * @property int $userId
 * @property int $status
 * @property string $text
 * @property string $link
 * @property int $month
 * @property string $createDate
 * @property string $endDate
 */
class Advertising extends ActiveRecord
{

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
            [['userId', 'status', 'text', 'link', 'month', 'createDate', 'endDate'], 'required'],
            [['userId', 'status', 'month'], 'integer'],
            [['text'], 'string'],
            [['createDate', 'endDate'], 'safe'],
            [['link'], 'string', 'max' => 255],
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'userId'] );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'userId' => 'Имя пользователя',
            'status' => 'Статус заявки',
            'text' => 'Описание ресурса',
            'link' => 'Ссылка',
            'month' => 'Кол-во месяцев',
            'createDate' => 'Дата начала рекламы',
            'endDate' => 'Дата окончания рекламы',
        ];
    }

    public function sendAdvertisingOk()
    {

        $summa = 100 * $this->month;


        $sendingResult = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->user->email)
            ->setSubject('Ваша заявка на рекламу одобрена')
            ->setHtmlBody('<p>Укажите статус платежа:  За рекламу №'.$this->id.'</p><p>Номер карты Приват банк: -</p><p>Оплатите: '.$summa.' грн.</p>')
            ->send();

        return $sendingResult;
    }

    public function sendAdvertisingOn()
    {

        $summa = 50 * $this->month;


        $sendingResult = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->user->email)
            ->setSubject('Реклама включена')
            ->setHtmlBody('<p>Реклама включена. Вы можете посмотреть отчёт в личном кабинете.</p>')
            ->send();

        return $sendingResult;
    }

    public function sendAdvertisingNo()
    {

        $sendingResult = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->user->email)
            ->setSubject('Заявка на рекламу отклонена.')
            ->setHtmlBody('<p>Заявка на рекламу отклонена.</p>')
            ->send();

        return $sendingResult;
    }
}
