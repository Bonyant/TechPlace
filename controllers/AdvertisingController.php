<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 23.10.2017
 * Time: 22:18
 */

namespace app\controllers;
use app\controllers\CustomController;
use app\models\Advertising;
use app\models\Ads;
use Yii;
use app\components\MhtFileMaker;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;


class AdvertisingController extends CustomController
{

    public function actions()
    {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionApplication ()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('info', " Вы должны быть зарегистрированы.");
            return $this->redirect('/');
        }
        $this->setMeta('TechPlace | Заявка на рекламу', 'blog', 'Блог о технике и не только');
        
        $model = new Advertising();

        if($model->load(Yii::$app->request->post()))
        {
            $model->status = 0;
            $model->userId = Yii::$app->user->id;
            
            if($model->save())
            {
                
                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image)
                {
                    $model->upload();
                }

                $model->sendAdvertising();
                Yii::$app->session->setFlash('success', " Заявка успешно отправлена.");
                return $this->goHome();
            }
            
        }
        
        return $this->render('application', compact('model') );
    }


    public function actionAds()
    {
        $id = (int)Yii::$app->request->get('id');

        $model = Advertising::findOne($id);
        
        $ads = new Ads();
        $ads->idAdv = $model->id;
        $ads->save();

        return $this->redirect($model->link);

    }

    public function actionReport()
    {

        $idAdv = Yii::$app->request->get('adv');
        $query = Ads::find()->where(['idAdv' => $idAdv]);
        $this->layout = 'doc';

        $MhtFileMaker = new MhtFileMaker();
        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);
        $content = $this->render('report', compact('dataProvider'));

        $MhtFileMaker->AddContents("index.html","text/html" ,$content);

        header('Content-Type: application/ms-word');
        header('Content-Disposition: attachment;filename="'.$idAdv.'.doc"');
        header('Cache-Control: max-age=0');

        $MhtFileMaker->MakeFile('php://output');
    }
}