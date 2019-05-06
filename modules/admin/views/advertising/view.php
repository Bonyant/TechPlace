<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advertising */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки на рекламу', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Заявка №'.$this->title;
?>
<div class="advertising-view">

    <h1>Заявка №<?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'text:ntext',
            [
                'attribute' => 'link',
                'value' => function ($data)
                {
                    return '<a href="'.$data->link.'">Ссылка на ресурс рекламодателя</a>';
                },
                'format' => 'html',
            ],
            'month',
            [
                'attribute' => 'createDate',
                'value' => function ($data)
                {
                    return $data->createDate;
                },
                'format' => 'date',
            ],
            [
                'attribute' => 'endDate',
                'value' => function ($data)
                {
                    return $data->endDate;
                },
                'format' => 'date',
            ],

        ],
    ]) ?>

</div>
