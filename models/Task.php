<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
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
 * @property int $files_id
 * @property string $created_at
 * @property string|null $adress
 *
 * @property Category $category
 * @property City $city
 * @property Files $files
 * @property Reviews[] $reviews
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id', 'status', 'name', 'details', 'deadline', 'files_id', 'created_at'], 'required'],
            [['category_id', 'user_id', 'city_id', 'status', 'budget', 'files_id'], 'integer'],
            [['coordinates'], 'string'],
            [['deadline', 'created_at'], 'safe'],
            [['name', 'adress'], 'string', 'max' => 128],
            [['details'], 'string', 'max' => 512],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['files_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['files_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'city_id' => 'City ID',
            'coordinates' => 'Coordinates',
            'status' => 'Status',
            'name' => 'Name',
            'details' => 'Details',
            'budget' => 'Budget',
            'deadline' => 'Deadline',
            'files_id' => 'Files ID',
            'created_at' => 'Created At',
            'adress' => 'Adress',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery|FilesQuery
     */
    public function getFiles()
    {
        return $this->hasOne(Files::class, ['id' => 'files_id']);
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }
}
