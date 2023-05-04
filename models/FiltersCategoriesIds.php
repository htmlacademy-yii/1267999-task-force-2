<?php
namespace app\models;
use yii\base\Model;

/**
 * Модель формы фильтрации задач
 */
class FiltersCategoriesIds extends Model
{
    const WITHOUT_HOUR = 'ALL PERIOD';
    const ONE_HOUR = '1';
    const HALF_DAY = '12';
    const ONE_DAY = '24';
    const SERVICES = 'Курьерские услуги';
    const CARGO = 'Грузоперевозки';
    const TRANSLATE = 'Переводы';

    public $categories;
    public $withoutPerformer;
    public $period;

    /**
     * @return array Список меток атрибутов
     */
    public  function attributeLabels(): array
    {
        return [
            'categories' => 'Категории',
            'withoutPerformer' => 'Без исполнителя',
            'period' => 'период',
        ];
    }

    public function getLabelCategories()
    {
        return [
            self::SERVICES => 'Курьерские услуги',
            self::CARGO => 'Грузоперевозки',
            self::TRANSLATE => 'Переводы',
        ];
    }


    /**
     * @return array массив периодов времени используемых в фильтрации
     */
    public function getPeriods(): array
    {
        return [
            self::WITHOUT_HOUR => 'Весь период',
            self::ONE_HOUR => '1 час',
            self::HALF_DAY => '12 часов',
            self::ONE_DAY => '24 часа',
        ];
    }
}
