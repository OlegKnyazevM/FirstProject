<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;


class CategoryController extends AppController
{
    public function actionIndex()
    {

        $hits = Product::find()->where(['hit' => true])->limit(6)->all();
        $this->setMeta('E-SHOPPER');
        return $this->render('index', ['hits' => $hits]);
    }

    public function actionView($id){
//        $id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
        if (empty($category)){
            throw new \yii\web\HttpException(404, 'Такой категории нет');
        }
//        debug($id);
//        $products = Product::find()->where(['category_id' => $id])-> all();
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize'=>3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description );
        return $this->render('view', compact('products', 'pages', 'category'));
    }

    public function actionSearch(){
        $q = Yii::$app->request->get('q');
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize'=>3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }

} 