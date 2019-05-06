<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'visible' => false],

            'title',
            'description',
            'keywords',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действие',
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
                'buttons'=> [
                    'view' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['/admin/category/view', 'id' => $model->id],
                            [
                                'class' => 'label btn-success',
                                'title' => 'Посмотреть',
                                'aria-label' => 'Посмотреть',
                            ]);
                    },

                    'update' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['/admin/category/update', 'id' => $model->id],
                            [
                                'class' => 'label btn-primary',
                                'title' => 'Редактировать',
                                'aria-label' => 'Редактировать',
                            ]);
                    },

                    'delete' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['/admin/category/delete', 'id' => $model->id],
                            [
                                'class' => 'label btn-danger',
                                'title' => 'Удалить',
                                'aria-label' => 'Удалить',
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
