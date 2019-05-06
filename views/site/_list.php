<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 12.09.2017
 * Time: 22:54
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article class="box post post-excerpt">
    <header>
        <h2><a href="<?= Url::to(['site/view', 'lesson'=>$model->id]) ?>"><?= $model->title ?></a></h2>
        <!--<p>A free, fully responsive HTML5 site template by HTML5 UP</p>-->
    </header>
    <div class="info">
        <span class="date"><span class="month">Пост<span>y</span></span><span class="day">№<?= $model->lesson ?></span><span class="year"></span></span>
        <ul class="stats">
            <li><a href="#" class="icon fa fa-eye"><?= $model->views?></a href="#"></li>
        </ul>
    </div>


    <p class="mark text-default lead"><?= $model->description ?></p>
    <p><?= $model->video ?></p>
<!--    --><?php //$img = $model->getImage(); ?>
<!--    --><?//= Html::img($img->getUrl('1038x584'), ['alt' => $model->title, 'class' => 'image featured']) ?>
<!--    <a href="#" class="image featured"><img src="images/pic01.jpg" alt="Контент отсутствует или не был прогружён" /></a>-->
<!--     --><?//= $model->text ?>

</article>
