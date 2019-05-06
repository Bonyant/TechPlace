<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
$prompt = ['prompt' => 'Выберите категорию поста'];
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCategory')->dropDownList(
        $category,
        $prompt
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lesson')->textInput() ?>
    
    <?= $form->field($model,'text')->widget(CKEditor::className(),[
    'editorOptions' => [
    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
    'inline' => false, //по умолчанию false
    ],
    ]); ?>

    <?= $form->field($model, 'video')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'views')->textInput(['readonly'=> true, 'value' => 0]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date('Y-m-d H:i')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
