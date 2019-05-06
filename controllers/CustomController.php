<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 26.07.2017
 * Time: 22:52
 */

namespace app\controllers;


use yii\web\Controller;

class CustomController extends Controller
{

    /**
     *
     * Заполняем титл и тд.
     *
     * @param null $title
     * @param null $keywords
     * @param null $description
     */
    protected  function setMeta ($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title; // Возвращаем title на страницу
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]); // Возвращаем keywords на страницу
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]); // Возвращаем description на страницу
    }

}