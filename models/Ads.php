<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string $clickDate
 * @property int $idAdv
 */
class Ads extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['clickDate'],
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
        return 'ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAdv'], 'required'],
            [['clickDate'], 'safe'],
            [['idAdv'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clickDate' => 'Время клика',
            'idAdv' => '№ рекламной компании',
        ];
    }
}
