<?php
namespace app\controllers;
use app\models\Tasks;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TasksController extends Controller
{
    public function actionIndex() {
        $tasks = Tasks::find()->orderBy(['created_at' => SORT_ASC])->where(['status' => '1'])->joinWith('category')->all();
        return $this->render('index', ['tasks' => $tasks]);
    }
}