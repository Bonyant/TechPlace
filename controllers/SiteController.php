<?php

namespace app\controllers;

use app\models\Advertising;
use app\models\Comment;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\controllers\CustomController;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Lesson;
use yii\data\ActiveDataProvider;
use app\models\Category;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use rico\yii2images\controllers\ImagesController;

class SiteController extends CustomController
{

    public $Password;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @return string
     */
    public function actionIndex()
    {

        $categoryId = (int)Yii::$app->request->get('categoryId');
        $query = Lesson::find();

//        $model = Advertising::find()->asArray()->all();
//
//        $array = array_rand($model, 1);
//
//
//
//        CustomController::printr($model[$array]['id']);
//        exit;

        if ($categoryId)
        {
            $category = Category::findOne($categoryId);
            $this->setMeta($category->title, $category->keywords, $category->description);
            $query->where(['idCategory' => $categoryId]);
            $query->orderBy('id ASC');
        }
        else
        {
            $this->setMeta('TechPlace', 'blog', 'Блог про технику и не только');
            $query->orderBy('id DESC');
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
              'pageSize' => 3,
            ],
        ]);
        return $this->render('index', compact('dataProvider'));
    }

    public function actionView()
    {
        $lesson = (int)Yii::$app->request->get('lesson');

        $model = Lesson::findOne($lesson);


        if (!$model)
        {
            ?><h2><?php
            throw new NotFoundHttpException('Такой категории не существует.');?>
            </h2><?php
        }

        $model->views += 1;
        $model->save();
        $this->setMeta($model->title, $model->keywords, $model->description);
        /**
         * Вытаскиваем коментарии в массиве
         */
        $comments = Comment::find()->where(['id_lesson' => $lesson])->indexBy('id')->asArray()->all();

        /**
         * Разбираем массив масивов коментарий
         */

        $tree = [];

        foreach ($comments as $id=>&$node)
        {
            if (!$node['parent_id'])
            {
                $tree[$id] = &$node;
            }
            else
            {
                $comments[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }

        $comment = new Comment();

        if ($comment->load(Yii::$app->request->post()))
        {

            $user = User::findOne(Yii::$app->user->id);

            $comment->id_lesson = $lesson;
            $comment->user_name = $user->username;
            $comment->parent_id = (int)$comment->parent_id;

            /**
             * Проверка на взлом БД
             */

            if ($comment->parent_id !=0)
            {
                $les = Comment::find()->where(['id' => $comment->parent_id])->all();
                if (!$les)
                {
                    throw new NotFoundHttpException('Такого комментария нет.');
                }
                else
                {
                    $comment->save();
                }
            }
            else if($comment->parent_id == 0)
            {
                $comment->save();
            }

            return $this->redirect(['view', 'lesson' => $lesson]);
        }
        else
        {
            return $this->render('view', compact('model', 'tree', 'comment'));
        }

        /*CustomController::printr($tree);
        exit;*/
    }

    public function actionSearch()

    {

// Разбераем запрос

        $search = Yii::$app->request->get('search');

// Обрезаем пробелы

        $search = str_replace(' ', '', $search);

// Поисковый запрос с поиском и обрезанием пробелов

        $query = Lesson::find()->where(['like', 'replace(title, " ", "")', $search]);

        $this->setMeta('Поиск', 'blog', 'TechPlace');

//Строим ActiveDataProvider

        $dataProvider = new ActiveDataProvider([

            'query' => $query,

            'pagination' =>[

                'pageSize' => 3,

            ],

        ]);

// Передаём в вид index

        return $this->render('index', compact('dataProvider', 'search'));

    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        $model->scenario = 'login';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
//
//    /**
//     * Регистрация в модальном окне
//     * @return array|string|Response
//     *
//     * @throws \yii\base\Exception
//     */
//    public function actionRegistr()
//    {
//        if(!Yii::$app->user->isGuest)
//        {
//            return $this->redirect('/');
//        }
//        // Подключаемся к модели
//        $model = new User();
//        // Если чтото пришло
//
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
//        {
//            $this->Password = $model->password;
//            if(!User::find()->where(['email'=> $model->email])->limit(1)->all())
//            {
//                $model->password= Yii::$app->security->generatePasswordHash($model->password);
//                $model->code = Yii::$app->getSecurity()->generateRandomString(10);
//                $model->active = 0;
//                if ($model->save())
//                {
//                    $model->sendConfirmationLink();
//                    Yii::$app->session->setFlash('success', " Выслана ссылка для потверждения Вашей почты.");
//                    return $this->redirect('/');
//                }
//                else
//                {
//                    Yii::$app->response->format = Response::FORMAT_JSON;
//                    return ActiveForm::validate($model);
//                }
//            }
//            else {
//                return $this->redirect('/');
//            }
//        }
//        return $this->renderAjax('_form_registr', compact('model'));
//    }
    /**
     *
     * Регистрация на отдельной странице
     *
     * @return string|Response
     */
    public function actionRegister()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->redirect('/');
        }
        $this->setMeta('TechPlace | Регистрация', 'blog', 'Блог о технике и не только');
        // Подключаемся к модели
        $model = new User();
        $model->scenario = 'register';
        // Если чтото пришло
        if ($model->load(Yii::$app->request->post()))
        {
            $this->Password = $model->password;

            if(!User::find()->where(['email'=> $model->email])->limit(1)->all())
            {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                $model->code = Yii::$app->getSecurity()->generateRandomString(10);
                $model->active = 0;
                $model->advert = 0;
                if ($model->save())
                {
                    //Назночаем Роль пользователя
                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('user');
                    $auth->assign($authorRole, $model->id);
                    // Отправляем письмо с потверждением емейла
                    $model->sendConfirmationLink();
                    Yii::$app->session->setFlash('success', " Выслана ссылка для потверждения Вашей почты.");
                    return $this->goHome();
                }

                else
                {
                    $model->password = $this->Password;
                    return $this->render('register', compact('model'));
                }
            }
            else
            {
                Yii::$app->session->setFlash('info', " Пользователь с таким E-mail зарегистрирован.");
                return $this->render('register', compact('model'));
            }

        }
        return $this->render('register', compact('model'));
    }



    public function actionConfirmemail()
    {
        // Если пользователь авторизован, то возврощаем на домашнюю страницу
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        // разбираем ссылку
        $code = htmlspecialchars(Yii::$app->request->get('code'));
        $email = htmlspecialchars(Yii::$app->request->get('email'));

        // Ищим пользователя с таким E-mail и code
        $model = User::find()->where(['email' => $email, 'code' => $code])->one();
        // Если нашли
        if ($model->id)
        {
            $model->code = '';
            $model->active = User::ACTIVE_USER;
            $model->save();
            $model->login();
            Yii::$app->session->setFlash('success', "Ваш E-mail потверждён.");
            return $this->goHome();
        }
        else
        {
            Yii::$app->session->setFlash('errors', "Такого  E-mail нет.");
            return $this->goHome();
        }

    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionAds()
    {
        $id = (int)Yii::$app->request->get('id');

        $model = Advertising::findOne($id);

        return $this->redirect($model->link);
        
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


}
