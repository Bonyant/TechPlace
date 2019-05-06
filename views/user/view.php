<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 05.10.2017
 * Time: 22:36
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\ActiveRecord;

$this->params['breadcrumbs'][] = $this->title;
?>

<article class="box post post-excerpt">
    <div class="col-lg-12">
        <div class="col-lg-4">
            <?php $img = $model->getImage(); ?>
            <?= Html::img($img->getUrl('250x250'), ['alt' => $model->username, 'class' => 'imagefeatured']) ?>
        </div>
        <div class="col-lg-8">
            <p>Статус: <?= Yii::$app->user->can('admin') ? 'Админинистратор' : 'Пользователь' ?></p>
            <p>Имя : <?= $model->username ?></p>
            <p>E-mail : <?= $model->email ?></p>
            <div class="col-lg-4">
                <a href="<?= Url::to(['user/update']) ?>">Редактировать профиль</a>
            </div>
            <div class="col-lg-4">
                <a href="<?= Url::to(['user/replacement']) ?>">Изменить пароль</a>
            </div>
        </div>



    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'visible' => false],

            'idAdv',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Распечатать отчёт',
                'template' => '{print}&nbsp;&nbsp;',
                'buttons'=> [
                    'print' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="fa fa-print"></span>',
                            ['/advertising/report', 'adv'=>$model->idAdv],
                            [
                                'class' => 'label btn-success',
                                'title' => 'Распечатать отчёт',
                                'aria-label' => 'Распечатать отчёт',
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>

</article>
