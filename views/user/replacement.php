<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 05.10.2017
 * Time: 23:44
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<article class="box post post-excerpt">
    <div class="col-lg-12">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin()?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class' => 'text']) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
        <div class="col-lg-3"></div>

    </div>

</article>
