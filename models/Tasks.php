<?php
namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property int|null $city_id
 * @property string|null $coordinates
 * @property int $status
 * @property string $name
 * @property string $details
 * @property int|null $budget
 * @property string $deadline
 * @property int $file_id
 * @property string $created_at
 * @property string|null $address
 *
 * @property Categories $category
 * @property Cities $city
 * @property Files $file
 * @property Reviews[] $reviews
 * @property Users $user
 */
class Tasks extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'customer_id', 'status', 'name', 'details', 'deadline', 'file_id', 'created_at'], 'required'],
            [['category_id', 'customer_id', 'city_id', 'status', 'budget', 'file_id', 'executor_id'], 'integer'],
            [['coordinates'], 'string'],
            [['deadline', 'created_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 128],
            [['details'], 'string', 'max' => 512],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['city_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['file_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['executor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'customer_id' => 'User ID',
            'city_id' => 'City ID',
            'coordinates' => 'Coordinates',
            'status' => 'Status',
            'name' => 'Name',
            'details' => 'Details',
            'budget' => 'Budget',
            'deadline' => 'Deadline',
            'file_id' => 'File ID',
            'created_at' => 'Created At',
            'address' => 'Address',
            'executor_id' => 'Executor Id',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CitiesQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery|FilesQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::class, ['id' => 'file_id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery|ReviewsQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getCustomers()
    {
        return $this->hasOne(Users::class, ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Executors]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getExecutors()
    {
        return $this->hasOne(Users::class, ['id' => 'executor_id']);
    }

    /**
     * {@inheritdoc}
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }
}
