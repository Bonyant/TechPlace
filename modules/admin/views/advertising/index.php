<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на рекламу';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertising-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?//= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'visible' => false],

            [
                'attribute' => 'userId',
                'value' => function ($data)
                {
                    return $data->user->username;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($data)
                {
                    switch ($data->status)
                    {
                        case 0 :
                            return 'Не одобрена';
                            break;
                        case 1 :
                            return 'Одобрена';
                            break;
                    }
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действие',
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}&nbsp;&nbsp;{ok}&nbsp;&nbsp;{no}',
                'buttons'=> [
                    'view' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['/admin/advertising/view', 'id' => $model->id],
                            [
                                'class' => 'label btn-success',
                                'title' => 'Посмотреть',
                                'aria-label' => 'Посмотреть',
                            ]);
                    },

                    'update' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['/admin/advertising/update', 'id' => $model->id],
                            [
                                'class' => 'label btn-primary',
                                'title' => 'Редактировать',
                                'aria-label' => 'Редактировать',
                            ]);
                    },

                    'delete' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['/admin/advertising/delete', 'id' => $model->id],
                            [
                                'class' => 'label btn-danger',
                                'title' => 'Удалить',
                                'aria-label' => 'Удалить',
                            ]);
                    },
                    'ok' => function ($url, $model, $key)
                    {
                        return Html::a('<i class="fa fa-check-circle"></i>',
                            ['/admin/advertising/ok', 'id' => $model->id],
                            [
                                'class' => 'label btn-success',
                                'title' => 'Одобрить',
                                'aria-label' => 'Одобрить',
                            ]);
                    },
                    'no' => function ($url, $model, $key)
                    {
                        return Html::a('<i class="fa fa-times"></i>',
                            ['/admin/advertising/no', 'id' => $model->id],
                            [
                                'class' => 'label btn-danger',
                                'title' => 'Отказать',
                                'aria-label' => 'Отказать',
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
