<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 05.10.2017
 * Time: 23:04
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin()?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'text']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'text']) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>

</div>
