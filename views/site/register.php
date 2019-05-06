<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 10.08.2017
 * Time: 21:56
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$title = 'Регистрация';
$this->params['breadcrumbs'][] = $title;
?>


<div class="col-lg-12">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
<?php $form = ActiveForm::begin([]); ?>

        <?= $form->field($model, 'username')->textInput(); ?>

        <?= $form->field($model, 'email')->textInput(); ?>

        <?= $form->field($model, 'password')->passwordInput(); ?>


<div class="form-group">
    <?= Html::submitButton('Зарегистрироватся', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-4"></div>
</div>