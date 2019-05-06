<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use app\components\LoginWidget;
use app\components\MenuWidget;
use app\components\AdsWidget;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
        <?php $this->head() ?>
    </head>
    <body class="left-sidebar">
    <?php $this->beginBody() ?>
        <div id="wrapper">
            <!-- Content -->
            <div id="content">

                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>

                <?php if( Yii::$app->session->hasFlash('success') ):?>

                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>


                <?php endif; ?>

                <?php if( Yii::$app->session->hasFlash('info') ):?>

                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('info'); ?>
                    </div>


                <?php endif; ?>

                <!-- вывод сообщения об ошибки-->
                <?php if( Yii::$app->session->hasFlash('error') ):?>

                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('error'); ?>
                    </div>

                <?php endif; ?>

<!--                <div class="panel">-->
<!--                     Контент -->
<!--                    --><?//= LoginWidget::Widget(['views' => 'login']) ?>
<!--                </div>-->

                <?= $content ?>
            </div>

            <div id="sidebar">

                <!-- Logo -->
                <h1 id="logo"><a href="#" style="cursor: default;">TechPlace </a></h1>
                <div class="text-center" style="margin-top: 20px;"><a style="text-align: right; font: bold 13px sans-serif" href="<?= Url::to(['/']) ?>">Вернуться к последним постам</a></div>
                <!-- Nav -->
                <nav id="nav">

                    <ul>
                        <li class="text-center">Категории:</li>
                        <?= MenuWidget::Widget(['views' => 'menu']) ?>
                        <?php $url = Yii::$app->request->resolve(); ?>
                        <li class="text-center">Остальное:</li>
                        <li <?php if($url[0] == 'site/about') echo "class=\"current\"" ?>><a href="<?= Url::to(['site/about']) ?>">О проекте</a></li>
                        <li <?php if($url[0] == 'site/contact') echo "class=\"current\"" ?> ><a href="<?= Url::to(['site/contact']) ?>">Обратная связь</a></li>
                        <li <?php if($url[0] == 'advertising/application') echo "class=\"current\"" ?> ><a href="<?= Url::to(['advertising/application']) ?>">Для рекламодателей</a></li>
                    </ul>
                </nav>


               <section class="box search">
                   <p class="text-center">Поиск по постам:</p>
                   <form method="get" action="<?= Url::to(['/site/search']) ?>">
                       <input type="text" class="text" name="search" placeholder="Например: Huawei" />
                   </form>
               </section>

                <section class="box text-style1">

                    <div class="inner">
                        <p class="text-center">Панель пользователя:</p>
                        <?= LoginWidget::Widget(['views' => 'login']) ?>
                        <?php
//                           Modal::begin([
//                                    'header' => '<h5>РЕГИСТРАЦИЯ</h5>',
//                                'toggleButton' => [
//                                        'label' => 'Регистрация',
//                                    'class' => 'btn btn-link reg'
//                                ]
//                            ]);
//                                echo '<div class="form"></div>';
//                            Modal::end();
                        ?>

                    </div>
                </section>

                <!-- Recent Posts -->
                <section class="box recent-posts">
                    <!--<header>
                        <h2>Recent Posts</h2>
                    </header>-->

                        <p class="text-center">Реклама:</p>
                        <?= AdsWidget::Widget(['views' => 'ads']) ?>
                </section>

                <!-- Recent Comments -->
                <!--<section class="box recent-comments">
                    <header>
                        <h2>Recent Comments</h2>
                    </header>
                    <ul>
                        <li>case on <a href="#">Lorem ipsum dolor</a></li>
                        <li>molly on <a href="#">Sed dolore magna</a></li>
                        <li>case on <a href="#">Sed dolore magna</a></li>
                    </ul>
                </section>-->

                <!-- Calendar -->
                <!--<section class="box calendar">
                    <div class="inner">
                        <table>
                            <caption>July 2014</caption>
                            <thead>
                            <tr>
                                <th scope="col" title="Monday">M</th>
                                <th scope="col" title="Tuesday">T</th>
                                <th scope="col" title="Wednesday">W</th>
                                <th scope="col" title="Thursday">T</th>
                                <th scope="col" title="Friday">F</th>
                                <th scope="col" title="Saturday">S</th>
                                <th scope="col" title="Sunday">S</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="4" class="pad"><span>&nbsp;</span></td>
                                <td><span>1</span></td>
                                <td><span>2</span></td>
                                <td><span>3</span></td>
                            </tr>
                            <tr>
                                <td><span>4</span></td>
                                <td><span>5</span></td>
                                <td><a href="#">6</a></td>
                                <td><span>7</span></td>
                                <td><span>8</span></td>
                                <td><span>9</span></td>
                                <td><a href="#">10</a></td>
                            </tr>
                            <tr>
                                <td><span>11</span></td>
                                <td><span>12</span></td>
                                <td><span>13</span></td>
                                <td class="today"><a href="#">14</a></td>
                                <td><span>15</span></td>
                                <td><span>16</span></td>
                                <td><span>17</span></td>
                            </tr>
                            <tr>
                                <td><span>18</span></td>
                                <td><span>19</span></td>
                                <td><span>20</span></td>
                                <td><span>21</span></td>
                                <td><span>22</span></td>
                                <td><a href="#">23</a></td>
                                <td><span>24</span></td>
                            </tr>
                            <tr>
                                <td><a href="#">25</a></td>
                                <td><span>26</span></td>
                                <td><span>27</span></td>
                                <td><span>28</span></td>
                                <td class="pad" colspan="3"><span>&nbsp;</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>-->

                <!-- Copyright -->

                <ul id="copyright">
                    <li>&copy; TechPlace</li>
                    <li>2019</li>
<!--                    <li><a href="--><?//= Url::to(['site/contact']) ?><!--">Реклама на сайте</a></li>-->
<!--                    <li><a href="--><?//= Url::to(['site/contact']) ?><!--">Правила</a></li>-->
                    <li>Все права защищены.</li>
                </ul>


            </div>

        </div>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
