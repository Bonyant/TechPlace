<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 23.10.2017
 * Time: 22:25
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;


$this->title = 'Для рекламодателей';
$this->params['breadcrumbs'][] = $this->title;
$prompt = ['prompt' => 'Выберите кол-во месяцев'];
?>

<div class="site-contact">

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Спасибо за обратную связь, мы свяжемся с Вами в ближайшее время.
        </div>


    <?php else: ?>




        <div class="col-lg-12">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">

                <p>
                    Заполните форму для отправки сообщения.
                </p>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'link')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'month')->dropDownList(
                    [
                        '1' => '1 месяц',
                        '3' => '3 месяца',
                        '6' => '6 месяцев',
                        '12' => '12 месяцев',

                    ],
                    $prompt
                ) ?>

                <?= $form->field($model, 'image')->fileInput() ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div>{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>


                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'button next', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-2"></div>
        </div>

    <?php endif; ?>
</div>


