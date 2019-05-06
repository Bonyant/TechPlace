<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 02.11.2017
 * Time: 22:56
 */

namespace app\components;
use yii\base\Widget;
use app\models\Advertising;

class AdsWidget extends Widget
{
    public $views;  // Параметры виджета для определения шаблона
    public $model; // Модель

    public function init()
    {
        parent::init();
        if( $this->views === null)
        {
            $this->views = 'ads';
        }
        $this->views .='.php';
    }

    public function run()
    {
        parent::run();

        $array = Advertising::find()->asArray()->all();

        $randArray = array_rand($array, 1);

        $model = Advertising::findOne($array[$randArray]['id']);


        //$model = Advertising::find()->orderBy('RAND()')->one();
        return $this->ToTemplate($model);
    }

    protected function ToTemplate($model)
    {
        ob_start();
        include __DIR__.'/views/'.$this->views;
        return ob_get_clean();
    }
}