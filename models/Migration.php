<?php
namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "migration".
 *
 * @property int $id
 * @property string $version
 * @property int $apply_time
 */
class Migration extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'migration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['version', 'apply_time'], 'required'],
            [['apply_time'], 'integer'],
            [['version'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'version' => 'Version',
            'apply_time' => 'Apply Time',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MigrationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MigrationQuery(get_called_class());
    }
}
