<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 10.08.2017
 * Time: 23:04
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\ActiveRecord;
?>

<?php if (Yii::$app->user->isGuest): ?>
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'action' => '/site/login'
        ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>


<!--        --><?//= $form->field($model, 'rememberMe')->checkbox([
//            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
//        ])?>
<!--        <div class="text-right"><a href="--><?//= Url::to(['/site/restore']) ?><!--">Забыли пароль?</a></div>-->
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-link', 'name' => 'login-button']) ?>
                <br>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="bottom text-center">
        Первый раз у нас ?
        <?= Html::a('Зарегистрироваться', Url::to(['/site/register'])/*, $options = []*/ ) ?>
    </div>

<?php else: ?>

<!--    --><?php //$img = $model->getImage(); ?>
<!--    <a href="--><?//= Url::to(['/user/view']) ?><!--">--><?//= Html::img($img->getUrl('150x150'), ['alt' => $model->username]) ?><!--</a>-->
    <p>Логин: <?= $model->username ?></p>
    <a href="<?= Url::to(['/user/view']) ?>">Личный кабинет</a>
    <?php  /* echo Yii::$app->user->can('admin') - проверяем роль пользователя */ ?>
    <?php if (Yii::$app->user->can('admin')) : ?>
        <br>
        <?= Html::a('Админ-панель', Url::to(['/admin'])/*, $options = []*/ ) ?>

    <?php endif; ?>
        <br>
        <?= Html::a('Выйти', Url::to(['/site/logout'])/*, $options = []*/ ) ?>



<?php endif; ?>
