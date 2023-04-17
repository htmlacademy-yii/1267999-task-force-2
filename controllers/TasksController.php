<?php
namespace app\controllers;
use app\models\Tasks;
use yii\web\Controller;
use Yii;

class TasksController extends Controller
{
    public function actionIndex() {
        if (Yii::$app->request->getIsPost()) {
            $tasks = new Tasks();
            $tasks->search(Yii::$app->request->post());
        } else {
            $tasks = Tasks::find()->orderBy(['created_at' => SORT_ASC])->where(['status' => '1'])->joinWith('category')->all();
        }
        return $this->render('index', ['tasks' => $tasks]);
    }
}