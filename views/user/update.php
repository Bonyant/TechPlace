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
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<article class="box post post-excerpt">
    <div class="col-lg-12">
        <div class="col-lg-4">
            <?php $img = $model->getImage(); ?>
            <?= Html::img($img->getUrl('250x250'), ['alt' => $model->username, 'class' => 'del_'.$img->id]) ?>
            <a href="#" class="delFoto" data-id="<?= $model->id ?>" data-img="<?= $img->id ?>">Удалить аватар</a>
        </div>
        <div class="col-lg-8">
            <?= $this->render('_form', compact('model')) ?>
        </div>
    </div>

</article>