<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Для дополнительных вопросов обратитесь, пожалуйста, на почту администратора данного сайта - crng2121@gmail.com.
    </p>
    <p>
        Мы всегда рады вам помочь. Спасибо, что следите за нами.
    </p>

</div>
