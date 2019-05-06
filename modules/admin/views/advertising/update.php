<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advertising */

$this->title = 'Редактировать заявку на рекламу №: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки на рекламу', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->text;
?>
<div class="advertising-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
