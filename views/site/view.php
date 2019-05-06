<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 21.09.2017
 * Time: 22:33
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => $model->category->title, 'url' => ['site/index', 'categoryId' => $model->category->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inner">


    <article class="box post post-excerpt">
        <header>
            <h2><a href=""><?= $model->title ?></a></h2>
            <!--<p>A free, fully responsive HTML5 site template by HTML5 UP</p>-->
        </header>
        <div class="info">
            <span class="date"><span class="month">Урок<span>y</span></span> <span class="day"><?= $model->lesson ?></span><span class="year"></span></span>
            <ul class="stats">
                <li><a href="#" class="icon fa fa-eye"><?= $model->views?></a href="#"></li>
            </ul>
        </div>
        <?= $model->video ?>
        <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
        <?= $model->text ?><br><br>
        <p class="text-center">Дата поста: <?= $model->getDate(); ?></p>

    </article>
    <script>
        Share = {
            vkontakte: function(purl, ptitle, pimg, text) {
                url  = 'http://vkontakte.ru/share.php?';
                url += 'url='          + encodeURIComponent(purl);
                url += '&title='       + encodeURIComponent(ptitle);
                url += '&description=' + encodeURIComponent(text);
                url += '&image='       + encodeURIComponent(pimg);
                url += '&noparse=true';
                Share.popup(url);
            },
            odnoklassniki: function(purl, text) {
                url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
                url += '&st.comments=' + encodeURIComponent(text);
                url += '&st._surl='    + encodeURIComponent(purl);
                Share.popup(url);
            },
            facebook: function(purl, ptitle, pimg, text) {
                url  = 'http://www.facebook.com/sharer.php?s=100';
                url += '&p[title]='     + encodeURIComponent(ptitle);
                url += '&p[summary]='   + encodeURIComponent(text);
                url += '&p[url]='       + encodeURIComponent(purl);
                url += '&p[images][0]=' + encodeURIComponent(pimg);
                Share.popup(url);
            },
            twitter: function(purl, ptitle) {
                url  = 'http://twitter.com/share?';
                url += 'text='      + encodeURIComponent(ptitle);
                url += '&url='      + encodeURIComponent(purl);
                url += '&counturl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            mailru: function(purl, ptitle, pimg, text) {
                url  = 'http://connect.mail.ru/share?';
                url += 'url='          + encodeURIComponent(purl);
                url += '&title='       + encodeURIComponent(ptitle);
                url += '&description=' + encodeURIComponent(text);
                url += '&imageurl='    + encodeURIComponent(pimg);
                Share.popup(url)
            },

            popup: function(url) {
                window.open(url,'','toolbar=0,status=0,width=626,height=436');
            }
        };
    </script>
    <h2>Поделиться в соц. сетях:</h2><br>
    <a style="cursor: pointer; text-decoration: none;" onclick="Share.vkontakte('URL','TITLE','IMG_PATH','DESC')"><i class="fa fa-vk" aria-hidden="true"></i> VK</a><br>
    <a style="cursor: pointer; text-decoration: none;" onclick="Share.facebook('URL','TITLE','IMG_PATH','DESC')"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a><br>
    <a style="cursor: pointer; text-decoration: none;" onclick="Share.twitter('URL','TITLE')"><i class="fa fa-twitter"></i> Twitter</a>
    <br>
    <br>
        <!--Коментарии-->

    <div class="comments">
        <h3 class="title-comments">Комментарии</h3>
        <p>Комментарии могут оставлять только зарегистрированые пользователи. Если у вас нет формы для отправки комментария под постом, то, пожалуйста, создайте личный аккаунт.</p>
        <hr>
        <ul class="media-list">
            <!-- Комментарий (уровень 1) -->
            <?php foreach ($tree as $comm) : ?>
            <li class="media">
                <div class="media-left">

                        <span class="media-object img-rounded"> <i class="fa fa-comment-o" aria-hidden="true"></i> </span>

                </div>

                <div class="media-body">
                    <div class="media-heading">
                        <div class="author"><?= $comm['user_name'] ?></div>
                    </div>
                    <div class="media-text text-justify"><?= $comm['text'] ?></div>
                    <div class="footer-comment">
                        <span class="comment-reply">
                        <a href="#comment-text" class="reply" data-comment="<?= $comm['id'] ?>">ответить</a>
                        </span>
                    </div>

                    <!-- Вложенный медиа-компонент (уровень 2) -->
                    <?php if (isset($comm['childs'])) : ?>
                        <?php foreach ($comm['childs'] as $child) : ?>
                    <div class="media">
                        <div class="media-left">
                                <span class="media-object img-rounded"> <i class="fa fa-comments-o" aria-hidden="true"></i> </span>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <div class="author"><?= $child['user_name'] ?></div>
                            </div>
                            <div class="media-text text-justify"><?= $child['text'] ?></div>
                            <!--<div class="footer-comment">

                                </span>
                                <span class="comment-reply">
                                <a href="#" class="reply">ответить</a>
                                </span>
                            </div>-->

                            <!-- Вложенный медиа-компонент (уровень 3) -->

                        </div>
                    </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- Конец вложенного комментария (уровень 2) -->

                </div>
            </li>
            <!-- Конец комментария (уровень 1) -->
            <?php endforeach; ?>
        </ul>
        <?php if(!Yii::$app->user->isGuest):?>
        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($comment, 'parent_id')->hiddenInput(['value' => 0])->label(false) ?>

        <?= $form->field($comment, 'text')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Комментировать', ['class' => 'button next']) ?>
        </div>


        <?php ActiveForm::end() ?>

        <?php endif;?>
    </div>

</div>
