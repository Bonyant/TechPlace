<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$prompt1 = ['prompt' => 'Выберите статус'];
$prompt2 = ['prompt' => 'Выберите кол-во месяцев'];
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advertising */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advertising-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            '1' => 'Одобрить',
            '0' => 'Отказать',

        ],
        $prompt1
    ) ?>

    <?= $form->field($model, 'month')->dropDownList(
        [
            '1' => '1 месяц',
            '3' => '3 месяца',
            '6' => '6 месяцев',
            '12' => '12 месяцев',

        ],
        $prompt2
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
