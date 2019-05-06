<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 05.10.2017
 * Time: 22:29
 */

namespace app\controllers;
use app\controllers\CustomController;
use app\models\Ads;
use app\models\Advertising;
use app\models\User;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use rico\yii2images\models\Image;
use yii\data\ActiveDataProvider;

class UserController extends CustomController
{
    
    public $Password; // Сдесь храним пароль
    
    // Просмотр страницы пользователя
    public function actionView()
    {
        if (!Yii::$app->user->isGuest)
        {
            $model = User::findOne(Yii::$app->user->id);
            $this->setMeta('Личный кабинет');

            $adv = [];
            foreach ($model->advertising as $id)
            {
                $adv[] .= $id->id;
            }
            $query = Ads::find()->where(['idAdv' => $adv])->groupBy('idAdv');

            $dataProvider = new ActiveDataProvider([
                'query' => $query
            ]);
            return $this->render('view', compact('model', 'dataProvider'));
        }
        else
        {
            throw new NotFoundHttpException('Вы не зарегистрированный пользователь.');
        }
    }

    // Редоктирование страницы пользователя
    public function actionUpdate()
    {
        if (!Yii::$app->user->isGuest)
        {
            $model = User::findOne(Yii::$app->user->id);
            $this->setMeta('Редактирование профиля');
            if($model->load(Yii::$app->request->post()) && $model->save())
            {
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->image)
                {
                    $model->upload();
                }
                Yii::$app->session->setFlash('success', "Ваши данные изменены");
                return $this->redirect('view');
            }

            return $this->render('update', compact('model'));
        }
        else
        {
            throw new NotFoundHttpException('Вы не зарегистрированный пользователь.');
        }
    }

    //Удаление аватара
   public function actionDelImg($id, $img = null)
   {
       //$model = User::finfOne(Yii::$app->user->id);
       $model = User::findOne((int)$id);
       if ($img !== null && ($image = Image::findOne($img)))
       {
           $model->removeImage($image);
       }
       return 'ok';

   }

    // Смена пароля
    public function actionReplacement()
    {
        if (!Yii::$app->user->isGuest)
        {
            $model = User::findOne(Yii::$app->user->id);
            $this->setMeta('Изменение пароля');
            $model->scenario = 'replacement';
            $model->password = $this->Password;
            if($model->load(Yii::$app->request->post()))
            {
                $this->Password = $model->password;
                $model->password = Yii::$app->security->generatePasswordHash($this->Password);
                if ($model->save())
                {
                    Yii::$app->session->setFlash('success', "Пароль успешно изменён");
                    return $this->redirect('view');
                }
                else{
                    $model->password = $this->Password;
                    return $this->render('replacement', compact('model'));
                }

            }

            return $this->render('replacement', compact('model'));
        }
        else
        {
            throw new NotFoundHttpException('Вы не зарегестрированный пользователь.');
        }
    }
}