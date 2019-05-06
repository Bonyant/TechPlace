<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 15.08.2017
 * Time: 23:33
 */
use yii\helpers\Url;
use yii\helpers\Html;


?>

<?php foreach ($model as $category) : ?>

    <li ><a href="<?= Url::to(['/site/index', 'categoryId' => $category->id]) ?>"><?= $category->title ?></a></li>
    
<?php endforeach; ?>
