<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 15.08.2017
 * Time: 23:30
 */

namespace app\components;
use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget
{
    public $views;  // Параметры виджета для определения шаблона
    public $model; // Модель

    public function init()
    {
        parent::init();
        if( $this->views === null)
        {
            $this->views = 'menu';
        }
        $this->views .='.php';
    }

    public function run()
    {
        parent::run();
            $model = Category::find()->all();
            return $this->ToTemplate($model);
    }

    protected function ToTemplate($model)
    {
        ob_start();
        include __DIR__.'/views/'.$this->views;
        return ob_get_clean();
    }
}