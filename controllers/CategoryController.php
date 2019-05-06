<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 12.09.2017
 * Time: 23:10
 */

namespace app\controllers;
use app\controllers\CustomController;
use app\models\Lesson;
use yii\data\ActiveDataProvider;
use app\models\Category;
use Yii;

class CategoryController extends CustomController
{
    public function actionView()
    {
        $categoryId = (int)Yii::$app->request->get('id');
        $category = Category::findOne($categoryId);
        $this->setMeta('TechPlace | '.$category->title, $category->keywords, $category->description);

        $query = Lesson::find();
        $query->where(['idCategory' => $categoryId]);
        $query->orderBy('id ASC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => 3,
            ],
        ]);
        
        return $this->render('view', compact('dataProvider'));
        
    }
}