<?php
namespace app\models;
use yii\db\ActiveRecord;

class Filters extends ActiveRecord
{

    public function attributeLabels()
    {
        return [
            'services' => 'Курьерские услуги',
            'cargo' => 'Грузоперевозки',
            'translate' => 'Переводы',
            'withoutexecutor' => 'Без исполнителя',
            'period' => 'Период'
        ];
    }

    public function rules()
    {
        return [
            [['services', 'cargo', 'translate', 'withoutexecutor', 'period'], 'safe'],
            [['services', 'cargo', 'translate', 'withoutexecutor', 'period'], 'required']];
    }
}
