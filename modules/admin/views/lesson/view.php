<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Lesson */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот пост?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'image',
                'value' => function ($data)
                {
                    $img = $data->getImage();
                    return Html::img($img->getUrl('100x100'));
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'idCategory',
                'value' => function ($data)
                {
                    return $data->category->title;
                },
            ],
            'title',
            'keywords',
            'description',
            'lesson',
            'text:ntext',
            'video:ntext',
            'views',
        ],
    ]) ?>

</div>
