<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 12.09.2017
 * Time: 23:21
 */
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
    'layout' => "{items}\n{pager}",
    /*'summary' => '<div class="right-align">Кол-во уроков: {totalCount}</div>',*/
]) ?>

