<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
    <br>
    <div class="text-center" style="font-size: 24px;">
        <h3>КОНТАКТЫ:</h3> <br>
        Харьков, ул. Сумская, 18/20.<br>
        Телефон: +38(066)448-75-26.<br>
        <a href="/">www.techplace.com</a><br>
    </div>
</div>
