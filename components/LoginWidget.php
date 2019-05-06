<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 11.08.2017
 * Time: 15:48
 */
namespace app\components;
use yii\base\Widget;
use app\models\User;
use yii\web\Controller;
use Yii;

class LoginWidget extends Widget
{
    public $views;  // Параметры виджета для определения шаблона
    public $model; // Модель

    public function init()
    {
        parent::init();
        if( $this->views === null)
        {
            $this->views = 'login';
        }
        $this->views .='.php';
    }

    public function run()
    {
        parent::run();

        if(!Yii::$app->user->isGuest)
        {
            $model = User::findOne(Yii::$app->user->id);
            return $this->ToTemplate($model);
        }
        else
        {
            $model = new User();
            return $this->ToTemplate($model);
        }
    }

    protected function ToTemplate($model)
    {
        ob_start();
        include __DIR__.'/views/'.$this->views;
        return ob_get_clean();
    }
}