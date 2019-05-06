<?php

/* @var $this yii\web\View */
namespace app\controllers;
//$this->title = 'My Yii Application';
use app\models\Category;
use app\models\Lesson;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\helpers\Html;
use app\controllers\CustomController;
use app\controllers\CategoryController;
use Yii;

if(isset($search1)) // проверяем существует ли переменая $search1

{

// Существует - Делаем хлебные крошки для поискового запроса

    $this->params['breadcrumbs'][] = $this->title .' - '. $search1;

}

else

{

//Не существует - Делаем хлебные крошки для обычного отображения

    $this->params['breadcrumbs'][] = $this->title ;

}
?>


<!--<div class="text-center">-->
<!--<h2>Сортировка постов:</h2>-->
<!--<a href="#" onclick="sortAsc();" style="text-align: right">От первого к последнему </a>|-->
<!--<a href="#" onclick="sortDesc();" style="text-align: right"> От последнего к первому</a>-->
<!--</div>-->
<div class="inner text-center">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
        'layout' => "{summary}\n{items}\n{pager}",
        'summary' => '<div class="text-center"><h2>Всего постов на сайте: {totalCount}</h2></div>',
    ]) ?>

<!--     Pagination -->
<!--    <div class="pagination">-->
<!--        <a href="#" class="button previous">Previous Page</a>-->
<!--        <div class="pages">-->
<!--            <a href="#" class="active">1</a>-->
<!--            <a href="#">2</a>-->
<!--            <a href="#">3</a>-->
<!--            <a href="#">4</a>-->
<!--            <span>&hellip;</span>-->
<!--            <a href="#">20</a>-->
<!--        </div>-->
<!--        <a href="#" class="button next">Next Page</a>-->
<!--    </div>-->

</div>