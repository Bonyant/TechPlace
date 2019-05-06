<?php

namespace app\models;

use app\modules\admin\models\Advertising;
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $autth_key
 * @property string $code
 * @property int $active
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ACTIVE_USER = 1; // Потверждённый E-mail
    public $rememberMe = true;
    public $image;
    private $_user = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }


    public function getAdvertising()
    {
        return $this->hasMany(Advertising::className(),['userId' =>'id'] );
    }

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
    public function rules()
    {
        return [
            [['email', 'username', 'password'], 'required' , 'on' => 'register'],
            [['active', 'advert'], 'integer'],
            [['email', 'username', 'password', 'auth_key', 'code'], 'string', 'max' => 255],
            [['auth_key', 'code', 'advert'], 'safe', 'on' => 'register'],
            [['email', 'password'], 'required', 'on' => 'login' ],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['auth_key', 'code', 'active', 'username', 'rememberMe'], 'safe' , 'on' => 'login'],
            ['rememberMe', 'boolean' , 'on' => 'login'],
            [['password'], 'required' , 'on' => 'replacement'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'email' => 'E-mail',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
            'image' => 'Аватар',
        ];
    }

    /**
     *
     * Отправка письма с потверждением регистрации
     *
     * @return mixed
     */
    // Функция генерации и отправки письма для потверждения E-mail
    public function sendConfirmationLink()
    {

        $confirmationLinkUrl = Url::to(['site/confirmemail', 'email'=>$this->email, 'code'=>$this->code]);
        $confirmationLink = Html::a('Подтвердить Email', $confirmationLinkUrl);

        $sendingResult = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->setSubject('Пожалуйста, подтвердите свой Email')
            ->setTextBody('Для прохождения регистрации Вам необходимо подтвердить свой Email, перейдя по ссылке: ' . $confirmationLinkUrl)
            ->setHtmlBody('<p>Для прохождения регистрации Вам необходимо подтвердить свой Email, перейдя по ссылке ниже:</p>' . $confirmationLink)
            ->send();

        return $sendingResult;
    }

    // Ищим пользователя по id
    public static function findIdentity($id)
    {
        return static ::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
         return static::findOne(['access_token' => $token]);
    }

    // Ищим пользователя по E-mail и проверяем потверждён ли аккаунт
    public static function findByUsername($email)
    {
        return static ::findOne(['email' => $email, 'active' =>self::ACTIVE_USER]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    // Проверяем пароль, каторый вёл пользователь
    public function validatePassword($password)
    {


        //  return $this->password === $password;
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    // Генерируем рандомную строку
    public function generateAuthKey()
    {
        if ($this->isNewRecord) {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }
    }


    public function login()
    {
        $this->scenario = 'login';
        if ($this->validate()) {

            if ($this->rememberMe)
            {
                $cookie = $this->getUser();
                $cookie->generateAuthKey();
                $cookie->save();

            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {

            $this->_user = $this->findByUsername($this->email);
        }
        return $this->_user;
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
