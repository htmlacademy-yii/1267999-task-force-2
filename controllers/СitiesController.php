<?php

namespace app\controllers;

use yii\db\Query;
use yii\web\Controller;


class СitiesController extends Controller
{
    public function actionIndex()
    {
        $query = new Query();

        $query->select(['id', 'name', 'code', 'coordinates']);
        $query->from('city');
        $rows = $query->all();
        var_dump('Города', $rows);

    }
}