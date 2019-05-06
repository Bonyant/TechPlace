<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 02.11.2017
 * Time: 22:59
 */
use yii\helpers\Html;
use yii\helpers\Url;
$img = $model->getImage();
?>


<section class="box text-style1">
    <div class="inner text-center">
        <a href="<?= Url::to(['/advertising/ads', 'id' => $model->id]) ?>"  target="_blank"><?= $model->text ?></a>
    </div>
</section>