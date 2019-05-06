<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advertising */

$this->title = 'Создание рекламы';
$this->params['breadcrumbs'][] = ['label' => 'Заявки на рекламу', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertising-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
