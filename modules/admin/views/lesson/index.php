<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пост', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'visible' => false],


            
            [
                'attribute' => 'idCategory',
                'value' => function ($data)
                {
                  return $data->category->title;
                },
            ],
            'lesson',
            'title',
            'keywords',
            'description',

             'text:ntext',
             'video:ntext',
             'views',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действие',
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
                'buttons'=> [
                    'view' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['/admin/lesson/view', 'id' => $model->id],
                            [
                                'class' => 'label btn-success',
                                'title' => 'Посмотреть',
                                'aria-label' => 'Посмотреть',
                            ]);
                    },

                    'update' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['/admin/lesson/update', 'id' => $model->id],
                            [
                                'class' => 'label btn-primary',
                                'title' => 'Редактировать',
                                'aria-label' => 'Редактировать',
                            ]);
                    },

                    'delete' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['/admin/lesson/delete', 'id' => $model->id],
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
