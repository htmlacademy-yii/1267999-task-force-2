<?php

namespace app\models;
use yii\base\Model;
use app\models\Tasks;
use app\models\Categories;
use Yii;

/**
 * Модель для поиска и фильтрации задач
 */
class TasksSearch extends Model
{
    public function getTasks()
    {
        $tasks = Tasks::find()
            ->orderBy(['created_at' => SORT_ASC])
            ->where(['status' => '1'])
            ->joinWith('category');
        $request = Yii::$app->getRequest();
        if ($request->getIsPost()) {
            $categories = $request->post()['FiltersCategoriesIds']['categories'];
            if ($categories) {
                $tasks = $tasks->all();
            } else {
                $tasks = $tasks->all();
            }
        }
        else {
            $tasks = $tasks->all();
        }
        return $tasks;
    }
}