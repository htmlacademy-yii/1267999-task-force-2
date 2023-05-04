<?php
namespace app\controllers;
use app\models\FiltersCategoriesIds;
use yii\web\Controller;
use Yii;
use yii\db\Query;
use \DateTime;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $filtersCategoriesIds = new FiltersCategoriesIds();
        $query = new Query();
        $query->select(['t.name', 't.budget', 'categories.name as category', 't.created_at', 't.details', 't.address', 't.executor_id'])
            ->from('tasks t')
            ->join('INNER JOIN', 'categories', 't.category_id = categories.id')
            ->orderBy(['t.created_at' => SORT_ASC]);
        $request = Yii::$app->getRequest();
        if ($request->getIsPost()) {
            $categories = $request->post()['FiltersCategoriesIds']['categories'];
            $withoutPerformer = $request->post()['FiltersCategoriesIds']['withoutPerformer'];
            $period = $request->post()['FiltersCategoriesIds']['period'];
            if ($withoutPerformer) {
                $tasks = $query->where(['>', 'executor_id', 00]);
            }
            if ($categories) {
                $tasks = $query->andWhere(['categories.name' => $categories]);
            }
            if ($period !== FiltersCategoriesIds::WITHOUT_HOUR) {
                $interval = new DateTime("{$period} hours ago");
                $tasks = $query->andFilterWhere(['>=', 'created_at', $interval->format('Y-m-d H:i:s')]);
            }
        }
        $tasks = $query->all();
        return $this->render('index', ['tasks' => $tasks, 'filtersCategoriesIds' => $filtersCategoriesIds]);
    }
}